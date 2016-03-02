
function menuDisplayControl() {
    // Find all of a elements in menu-target that have a class of black and iterate over each of them
    $('#menu-target li.black').each(function() {
        // Determine if the return of isElementInContainer is false (meaning the element is outside the menu)
        if (!isElementInContainer($(this))) {
            // Remove the black
            $(this).removeClass("black");
        }
    });

    // Find all the a elements in menu-target that do not have a class of black and iterate over each of them
    $('#menu-target li').not('.black').each(function() {
        // Determine if the return of isElementInContainer is true (meaning the elment is within the menu)
        if (isElementInContainer($(this))) {
            // add the black 
            $(this).addClass("black");
        }
    });
}

function isElementInContainer(element) {

    // Set the return variable to false
    var inContainer = false;
    // Get the position of the top of the element relative to the document by using offset() 
    // and subtract the distance from the area hidden above the window using scrollTop()
    // to get the position of the element relative to the window. Set that to elementTop.
    var elementTop = element.offset().top - $(window).scrollTop() + 25;
    // Determine the position of the bottom of the element by adding the hieght of the element 
    // to the elementTop variable
    var elementBottom = elementTop + element.height();

    // Use attribute selector to get all of the elements with data-menu='contrast' and iterate
    // over each of them.
    $('[data-menu="contrast"]').each(function() {
        // Take the object passed into the function and get the top position of the
        // selected element
        // console.log($(this));
        var containerTop = $(this).offset().top - $(window).scrollTop();
        // Bottom position of object passed into function
        var containerBottom = containerTop + $(this).outerHeight(true);
        // console.log( containerBottom + " " + containerTop );
        // If the bottom of the menu element is less than or equal to the top of the container
        // and the bottom of the menu element is greater than or equal to the bottom of the 
        // container then return true
        if ((elementBottom >= containerTop) && (elementBottom <= containerBottom)) {
            // If return true then this will add the black class to the items
            inContainer = true;
        }
    });

    // if the return is the original value of false it will remove the 
    // Class of black
    return inContainer;
};