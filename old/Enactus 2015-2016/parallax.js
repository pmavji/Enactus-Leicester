var touch = Modernizr.touch;
$('.parallax').imageScroll({
  imageAttribute: (touch === true) ? 'image-mobile' : 'image',
  touch: touch
});