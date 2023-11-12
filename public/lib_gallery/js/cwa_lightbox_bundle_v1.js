/*  
    Created on : 05 June 2023
    Author     : Tiego Masemola | Hashbrown_CWA
    https://cw-arts.netlify.app/about-us
*/

$(document).ready(function(){
    $('.cwa-lightbox-image').click(function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
        
        //clicked image file path
        var filepath=$(this).attr("href");

        //creates an array of the href (filepaths) of the images in the gallery, Stack Overflow (2012)
        $.fn.collect = function(fn) {
            var values = [];
        
            if (typeof fn == 'string') {
                var prop = fn;
                fn = function() { return this.attr(prop); };
            }
        
            $(this).each(function() {
                var val = fn.call($(this));
                values.push(val);
            });
            return values;
        };

        var href = $('.cwa-lightbox-image').collect('href');

        //checks if the clicked image exisst in the same index as in the array
        var currentIndex = 0;
        for(i = 0; i < href.length; i++){
            if(filepath == href[i]){
                currentIndex = i;
                break;
            }
        }

        // Define descriptions array
        var descriptions = [];
        $('.cwa-lightbox-image').each(function() {
            var desc = $(this).data('desc');
            descriptions.push(desc);
        });

        function showLightboxImage(n){
            if (n > href.length - 1) 
            {
                currentIndex = 0;
            }
            else if(n < 0){
                currentIndex = href.length - 1;
            }
            
            var loader = $(".lightbox-content .image-loader");
            var imageContainer = $(".lightbox-content img");

            //shows loader
            loader.css("display", "block");
            //hides image container
            imageContainer.css("display", "none");
    
            var newImg = new Image();
            newImg.src = href[currentIndex];
            
            newImg.onload = function() {
                imageContainer.css("display", "block");
                imageContainer.attr("src", newImg.src);
                
                loader.css("display", "none"); 
    
                var currentDesc = descriptions[currentIndex];
                
                $(".desc").html(currentDesc);
            };
    
            $(".pgNum").html(currentIndex + 1);
        }

        /* HTML LIGHTBOX COMPONENTS */
        $("body").append('<div class="lightbox-overlay"><div class="lightbox-content"></div></div>');

        //navigation buttons
        $(".lightbox-content").append('<a class="prev">&#10094;</a>');
        $(".lightbox-content").append('<a class="next">&#10095;</a>');
        $(".lightbox-overlay").append('<button class="close">&times;</button>');
        
        //index counter
        $(".lightbox-overlay").append('<div class="index-counter"><span class="pgNum"></span> | <span class="totalPg"></span></div>');
        $(".totalPg").html(href.length);

        //content/image description
        $(".lightbox-content").append('<div class="desc"></div>');
        $(".lightbox-content").append('<img loading="lazy">');
        $(".lightbox-content").append('<div class="image-loader"></div>');

        showLightboxImage(currentIndex);

        // disables scrolling in window
        $("body").css("overflow", "hidden");

        //css
        htmlStyling();

        function htmlStyling(){
            $('.lightbox-overlay').css({
                'position': 'fixed',
                'z-index': '10000',
                'padding': '2% 0',
                'left': '0',
                'top': '0',
                'width': '100%',
                'height': '100%',
                'overflow': 'auto',
                'background-color': '#000000e7'
            });
    
            $('.lightbox-content').css({
                'display': 'flex',
                'justify-content': 'center',
                'align-items': 'center',
                'height': '100%'
            });
            
            $('.lightbox-content img').css({
                'position': 'relative',
                'z-index': '101',
                'background-color': 'white',
                'transition': '5s',
                'max-height': '85vh',
                'max-width': '100vh',
                'padding': '1px',
                'margin': 'auto',
                'min-width': '1px',
                'min-height': '1px'
            });
    
            $('.close').css({
                'background-color': 'transparent',
                'border': 'none',
                'color': 'white',
                'position': 'absolute',
                'top': '5px',
                'right': '10px',
                'font-size': '40px',
                'font-weight': 'bold',
                'transition': '0.5s',
                'text-decoration': 'none',
                'cursor': 'pointer'
            });
    
            $('.close').hover(
                function () {
                    $(this).css({
                        'color': '#adb5bd'
                    });
                },
                function () {
                    $(this).css({
                        'color': 'white'
                    });
                }
            );
    
            $('.index-counter').css({
                'position': 'absolute',
                'color': 'white',
                'top': '10px',
                'z-index': '103',
                'left': '50%',
                'transform': 'translate(-50%)',
                'padding': '5px',
                'margin': 'auto',
                'font-size': '16px',
                'transition': '0.5s'
            });
    
            $('.desc').css({
                'position': 'absolute',
                'color': 'white',
                'bottom': '20px',
                'padding': '5px',
                'margin': 'auto',
                'font-size': '16px',
                'text-align': 'center',
                'transition': '0.5s'
            });
    
            $('.lightbox-content .image-loader').css({
                'position': 'absolute',
                'z-index': '102',
                'width': '80px',
                'height': '80px',
                'margin': 'auto',
                'border-radius': '50%',
                'border': '10px solid #616336',
                'border-top-color': 'white',
                'animation': 'spin 1s linear infinite'
            });

            // Create a <style> element
            var styleElement = $('<style>');
            // Set the CSS content with the @keyframes rule
            var keyframesCSS = '@keyframes spin { 100% { transform: rotate(360deg); } }';
            // Set the text content of the <style> element
            styleElement.text(keyframesCSS);
            // Append the <style> element to the <head> of the document
            $('head').append(styleElement);
    
            $('.prev, .next').css({
                'cursor': 'pointer',
                'position': 'absolute',
                'top': '50%',
                'width': 'auto',
                'padding': '16px',
                'margin-top': '-50px',
                'z-index': '102',
                'color': '#212529',
                'font-weight': 'bold',
                'font-size': '35px',
                'transition': '0.6s ease',
                'user-select': 'none',
                '-webkit-user-select': 'none',
                'background-color': '#adb5bd',
            });
    
            $('.next').css({
                'right': '0',
                'border-radius': '3px 0 0 3px'
            });
            
            $('.prev').css({
                'left': '0',
                'border-radius': '0 3px 3px 0'
            });

            $('.prev, .next').hover(
                function () {
                    $(this).css({
                        'background-color': '#212529',
                        'color': '#adb5bd'
                    });
                },
                function () {
                    $(this).css({
                        'background-color': '#adb5bd',
                        'color': '#212529'
                    });
                }
            );
            
            // Function to handle the window resize event
            function handleWindowResize() {
                var windowWidth = $(window).width();
    
                if (windowWidth <= 768) { 
                    // Tablet
                    $('.lightbox-content img').css({
                        'max-width': '70vh'
                    });

                    $('.prev, .next').css({
                        'font-size': '25px'
                    });
                } 
                else if (windowWidth <= 425) { 
                    // Mobile
                    $('.lightbox-content img').css({
                        'max-width': '50vh'
                    });

                    $('.prev, .next').css({
                        'font-size': '20px'
                    });
                } 
                else { 
                    // Desktop
                    $('.lightbox-content img').css({
                        'max-width': '100vh'
                    });

                    $('.prev, .next').css({
                        'font-size': '35px'
                    });
                }
            }
    
            // Initial handling of window resize event
            $(window).resize(function () {
                handleWindowResize();
            });
    
            // Execute the function on page load
            $(document).ready(function () {
                handleWindowResize();
            });
        }

        //CLICK EVENTS
        $(".lightbox-overlay>button").click(function(){
            $(".lightbox-overlay").remove();
            // enables scrolling in window
            $("body").css("overflow-y", "scroll");
        });

        $(".next").click(function(){
            showLightboxImage(currentIndex += 1);
        });

        $(".prev").click(function(){
            showLightboxImage(currentIndex -= 1);
        });

    });
});