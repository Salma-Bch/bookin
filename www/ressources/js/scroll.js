function scroll() {
	var figures = document.querySelectorAll("figure");
	var figure_1 = figures[0];
	var figure_2 = figures[1];
	var position_image_1 = figure_1.offsetTop;
	var position_image_2 = figure_2.offsetTop;
	function effet(){
		var position_curseur = this.pageYOffset;
		if(position_image_1-position_curseur < -500){
			figure_1.style.right = 0;
			figure_1.style.opacity = 1;
		}
		if(position_image_2-position_curseur<-500){
			figure_2.style.left = 0;
			figure_2.style.opacity = 1;
		}
	}
	window.addEventListener("scroll", effet);
}	scroll();
