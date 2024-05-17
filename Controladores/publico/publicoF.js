var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});


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

