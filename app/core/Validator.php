<?php 

class Validator{

	protected $errorHandler;

	protected $rules = ['required','maxlength','minlength','email','match'];

	protected $items;

	/**
		This is a list of error messages associated to the rules
	**/
	public $errorMsgs = [
		'required' => 'The :field field is required',
		'minlength' => 'The :field field must have at least :satisfier characters',
		'maxlength' => 'The :field field must have at most :satisfier characters',
		'email' => 'The :field field must be a valid email address',
		'match' => 'The :field field must match the :satisfier field'
	];

	public function __construct(ErrorHandler $errorHandler){
		$this->errorHandler= $errorHandler;
	}

	/**

		This method checks all items against their associated rules.
		If an item does not pass the check, an error is generated that can be later viewed via the errors() method.
	**/
	public function check($items, $rules){
		$this->items = $items;

		foreach($items as $item => $value){
			//check if each item has any associated rules
			if(in_array($item, array_keys($rules))){
				//validate each item according to its rules
				$this->validate([
					'field' => $item,
					'value' => $value,
					'rules' => $rules[$item]
				]);
			}
		}
		return $this;
	}

	/**

		This method returns an errorHandler, that can be used to view errors generated by check().
	**/
	public function errors(){
		return $this->errorHandler;
	}

	public function failed(){
		return $this->errorHandler->hasErrors();
	}

	protected function validate($data){
		$field = $data['field'];

		foreach($data['rules'] as $rule => $satisfier){
			if (in_array($rule, $this->rules)) {
				if (!call_user_func_array([$this, $rule], [$field, $data['value'], $satisfier])){
					$this->errorHandler->addError(
						str_replace(
							[':field', ':satisfier'],
							[$field, $satisfier], 
							$this->errorMsgs[$rule]
						),
						$field
					);
				}
			}
		}
	}

	protected function required($field, $value, $satisfier){
		return !empty(trim($value)) || $satisfier === false;
	}

	protected function minlength($field, $value, $satisfier){
		return mb_strlen($value) >= $satisfier;
	}

	protected function maxlength($field, $value, $satisfier){
		return mb_strlen($value) <= $satisfier;
	}

	protected function email($field, $value, $satisfier){
		return filter_var($value, FILTER_VALIDATE_EMAIL) || $satisfier === false;
	}

	protected function match($field, $value, $satisfier){
		return $value === $this->items[$satisfier];
	}

}

 ?>