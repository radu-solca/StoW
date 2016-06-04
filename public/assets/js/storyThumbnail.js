function getRatingStars(rating){
	// Make it integer:
	var stars = Math.round(rating * 2);

	var resultHTML = "";

	// Add full stars:
	var i = 1;
	while (i <= stars - 1) {
	    resultHTML += "<img src=\""+makeAbsolute("StoW/assets/img/star_f.png")+"\" />";
	    i += 2;
	}
	// Add half star if needed:
	if ( stars % 2 != 0 ) {
	    resultHTML += "<img src=\""+makeAbsolute("StoW/assets/img/star_h.png")+"\" />";
		i += 2;
	}
	// Add empty stars if needed
	while (i <= 10){
	    resultHTML += "<img src=\""+makeAbsolute("StoW/assets/img/star_e.png")+"\" />";
	    i += 2;
	}

	return resultHTML;
}

function getStoryThumbnail(story){

	var cover = fileExists(makeAbsolute(story['COVER'])) ? makeAbsolute(story['COVER']) : makeAbsolute("StoW/public/assets/img/nocover.png");

	var authors = story['AUTHORS'] != null ? "<div class=\"authors\">"+story['AUTHORS']+"</div>" : "";

	var thumbnailHTML = 
	"<div class=\"storyThumbnail\">"+
	"	<div class=\"container\">"+
	"		<a href=\"storyView/"+story['ID']+"\">"+
	"			<div class=\"overlay\">"+
	"				<div class=\"title\">"+story['TITLE']+"</div>"+
					authors+
	"				<div class=\"rating\">"+
						getRatingStars(story["RATING"])+
	"				</div>"+
	"			</div>"+
	"			<img class=\"storyCover\" alt=\"story cover\" src=\""+cover+"\""+
	"			/>"+
	"		</a>"+
	"	</div>"+
	"</div>";

	return thumbnailHTML;
}
