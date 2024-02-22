import { Splide } from "@splidejs/splide";
import { AutoScroll } from "@splidejs/splide-extension-auto-scroll";

export function slide() {
  if (document.querySelector(".splide01")) {
    new Splide(".splide01", {
      type: "loop",
      perPage: 3,
      perMove: 1,
      autoplay: true,
      interval: 3000,
      pauseOnHover: false,
      focus: 0,
    }).mount();
  }
  if (document.querySelector(".splide02")) {
    new Splide(".splide02", {
      perPage: 3,
      type: "loop",
      focus: 0,
      autoScroll: {
        speed: 2,
      },
    }).mount({ AutoScroll });
  }
}
