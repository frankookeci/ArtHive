// window.addEventListener('DOMContentLoaded', function () {
//     var sliderTrack = document.querySelector('.catalog-slide-track');
//     var images = sliderTrack.querySelectorAll('img');

//     var totalWidth = 0;
//     images.forEach(function (image) {
//         totalWidth += image.clientWidth;
//     });
//     document.documentElement.style.setProperty('--total-width', totalWidth + 'px');

//     sliderTrack.style.width = totalWidth2 + 'px';
//     console.log(totalWidth);

//     var sliderTrack2 = document.querySelector('.catalog-slide-track-2');
//     var images2 = sliderTrack2.querySelectorAll('img');

//     var totalWidth2 = 0;
//     images2.forEach(function (image) {
//         totalWidth2 += image.clientWidth;
//     });
//     document.documentElement.style.setProperty('--total-width2', totalWidth2 + 'px');


//     sliderTrack2.style.width = totalWidth2 + 'px';
//     console.log(totalWidth2);

// });

window.addEventListener('DOMContentLoaded', function () {
    document.documentElement.style.setProperty('--total-width', 1000 + 'px');
    document.documentElement.style.setProperty('--total-width2', 1000 + 'px');
});
