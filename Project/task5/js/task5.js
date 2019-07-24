$(document).ready(function(e) {
	let buttonEls = $('.section-header__button');
	const keyPositions = {1:[2,3,1],2:[3,1,2],3:[1,2,3]};
	let startPosition = 1;
	buttonEls.on('click', function (target) {
		function changeButton(key,buttons) {
			for (let i = 0 ; i<buttons.length; i++) 
			buttons[i].textContent = keyPositions[key][i];
			if (startPosition == 3) startPosition = 0;
			startPosition++;
		}
		changeButton(startPosition,buttonEls);
	});

});
