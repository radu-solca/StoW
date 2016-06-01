var input = document.querySelector('#fileToUpload');

var label = document.querySelector('#fileToUploadLabel'),
    labelVal = label.innerHTML;

input.addEventListener('change', function(file) {

    var fileName = '';
    if (this.files)
        fileName = file.target.value.split('\\').pop();

    if (fileName)
        label.innerHTML = fileName;
    else
        label.innerHTML = labelVal;
});