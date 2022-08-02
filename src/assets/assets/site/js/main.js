$(document).ready(function() {

    //ShowPassword
    $('.eye').on('click',function(e){
      input = $(this).parent().children('.password');
      inputType = input.attr('type');
      if(inputType == "password" ){
          input.attr('type' , 'text');
      }else{
          input.attr('type' , 'password');
      }
    });
  
    //Navbbar
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".nav-menu");
    const navLink = document.querySelectorAll(".nav-link");
    hamburger.addEventListener("click", mobileMenu);
    navLink.forEach(n => n.addEventListener("click", closeMenu));
    function mobileMenu() {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    }
    function closeMenu() {
        hamburger.classList.remove("active");
        navMenu.classList.remove("active");
    }
  
    //OwlEgaby
    $('.owl-carousel.owl-egaby').owlCarousel({
      loop:true,
      margin:25,
      nav:true,
      navText: ["<img src='"+base_url+"images/Group-8634.png' height='40' width='40'>", "<img src='"+base_url+"images/Group-8633.png' height='40' width='40'>"],
      autoplayTimeout:2000,
      autoplay:true,                                  
      autoplayHoverPause:true,
      nav:true,
      rtl:true,
      responsive:{
          0:{
              items:1
          },
          700:{
              items:2
          },
          1300:{
              items:3
          },
          1600:{
              items:3
          }
      }
  })

  //programmes-slider-images
  $('.owl-carousel.owl-programmes').owlCarousel({
    loop:true,
    margin:25,
    nav:true,
    autoplayTimeout:2000,
    autoplay:true,                                  
    autoplayHoverPause:true,
    nav:true,
    rtl:true,
    responsive:{
        0:{
            items:2
        },
        700:{
            items:2
        },
        1300:{
            items:3
        },
        1600:{
            items:3
        }
    }
})




//owl-sponsers
$('.owl-carousel.owl-sponsers').owlCarousel({
    loop:true,                                                                                             
    margin:10,
    autoplayTimeout:2000,
    autoplay:true,                                 
    autoplayHoverPause:true,
    center:true,                                        
    nav:false,                                                           
    rtl:true,
    responsive:{
        0:{
            items:2
        },
        700:{
            items:3
        },
        1300:{
            items:4
        },
        1600:{
            items:5
        }
    }
});


  //programmes-slider-images
    $('.owl-carousel.owl-top-ten').owlCarousel({
        loop:true,                                                                                             
        margin:25,
        autoplayTimeout:2000,
        autoplay:true, 
        items:8,                                 
        autoplayHoverPause:true,
        center:true,                                        
        nav:false,                                                           
        rtl:true,
        responsive:{
            0:{
                items:1
            },
            700:{
                items:2
            },
            1300:{
                items:3
            },
            1600:{
                items:5
            }
        }
    });


    //owl-carousel-view-images
    $('.owl-carousel.owl-carousel-view-images').owlCarousel({                                                                                          
        margin:25,
        autoplayTimeout:2000,
        autoplay:true,                                  
        autoplayHoverPause:true,                                       
        nav:false,                                                           
        rtl:true,
        responsive:{
            0:{
                items:2
            },
            700:{
                items:2
            },
            1300:{
                items:3
            },
            1600:{
                items:4
            }
        }
    });


});