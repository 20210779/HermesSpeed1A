const FOOTER = document.querySelector("footer");

FOOTER.innerHTML = `
    <footer class="bg-dark pt-2 pb-2">
    <div class="container-fluid bg-dark text-center">
      <div class="row align-items-center">
        <div class="col-md-4">
          <h5 class="text-light">@HermeSpeed</h5>
        </div>
        <div class="col-md-4 offset-md-4 pt-3">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 22px;">
                <i class="fa-brands fa-tiktok"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 22px;">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#" class="btn-floating btn-sm text-white" style="font-size: 22px;">
                <i class="fa-brands fa-x-twitter"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  `;

  var swiper = new Swiper('.swiper-container', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    slidesPerView: 1,
    spaceBetween: 10,
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  
    
    breakpoints: {
      620: {
      slidesPerView: 1,
      spaceBetween: 20,
      },
      680: {
      slidesPerView: 2,
      spaceBetween: 40,
      },
      920: {
      slidesPerView: 3,
      spaceBetween: 40,
      },
      1240: {
      slidesPerView: 4,
      spaceBetween: 50,
      },
    } 
      });