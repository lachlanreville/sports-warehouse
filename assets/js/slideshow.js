//Master SlideShow variable, sets the file name, image text and title for the slideshow.
const slideShow = [
    {
        fileName: 'image 1.png',
        imageText: "View our brand new range of",
        imageTitle: "Sports Balls"
    },
    {
        fileName: 'image 2.png',
        imageText: "Get protected with the new range of",
        imageTitle: "Protective helmets"
    },
    {
        fileName: 'image 3.png',
        imageText: "Get ready to race with our professional",
        imageTitle: "Training Gear",
    }
]

//master slide variable stating which slide it is on
let slide = slideShow.length - 1;
//if the slideshow is toggled or not
let toggled = false;

//when DOM is loaded do things
$(document).ready(function () {
    handlePage()
    //this triggers the slideshow changing
    function handlePage() {
        if (toggled == false) {

            changePage()
            // starts it every 5 seconds to change slides
            setTimeout(() => {
                handlePage();
            }, 5000)
        } else {
            setTimeout(() => {
                handlePage();
            }, 5000)
        }
    }
    // on the slideshow click toggle on/off
    $(".slideshow-wrapper").click(() => {
        if (toggled == false) {
            $('#slideshow-toggle-button').attr('class', 'fas fa-play')
            toggled = true;
        } else {
            $('#slideshow-toggle-button').attr('class', 'fas fa-pause')
            toggled = false;
        }
    })
    // controlling buttons at bottom of the slideshow changing pages based on the data index
    $(".control-icon").click(function () {
        changePage($(this).data("index"))
        $(this).attr('class', 'control-icon fas fa-circle')
        $('#slideshow-toggle-button').attr('class', 'fas fa-play')
        toggled = true;
    })
    //on press of the shop button dont toggle
    $('#slideshow-shop').click(function () {
        toggled = true;
        $(this).attr('class', 'control-icon fas fa-circle')
    })

});

//master slideshow function to change slideshow pages
async function changePage(index) {
    let image = $('#slideshow-images');
    let imagetext = $('#image-text');
    let imagetitle = $('#image-title');
    // changes the icon based on the old slide variable
    await $("i[data-index='" + slide + "']").attr('class', 'control-icon far fa-circle')

    // sets new slide variable
    if (index != null) {
        slide = index;
    } else {
        if (slideShow.length - 1 == slide) {
            slide = 0;
        } else {
            slide++
        }
    }
    // sets the slide icons to be enabled
    $("i[data-index='" + slide + "']").attr('class', 'control-icon fas fa-circle')


    // fade in/out the images and re-render the slideshow based on the new information in the variable based on the slide variable
    image.fadeOut('slow', function () {
        image.attr("src", "assets/images/slideshow/" + slideShow[slide].fileName)
            .on('load', function () {
                imagetext.text(slideShow[slide].imageText);
                imagetitle.text(slideShow[slide].imageTitle)
                $('#slideshow-shop').attr('href', '#')
                image.fadeIn('slow', function () {
                    return;
                })
            })

    })
}