import { gsap } from "gsap";

export function accordion() {
  // アコーディオンの開閉アニメーション
  const accordionGsap = () => {
    const accordions = document.querySelectorAll(".js-accordion");
    const isOpen = "is-open"; // アイコンの切り替え用クラス

    accordions.forEach((accordion) => {
      const summary = accordion.querySelector(".js-accordion-summary");
      const content = accordion.querySelector(".js-accordion-content");

      summary.addEventListener("click", (event) => {
        event.preventDefault(); // クリックイベントのキャンセル
        if (accordion.classList.contains(isOpen)) {
          accordion.classList.remove(isOpen); // アイコンの切り替え用クラスを削除
          closeAnimation(content, accordion).restart();
        } else {
          accordion.classList.add(isOpen); // アイコンの切り替え用クラスを追加
          accordion.setAttribute("open", "");
          openAnimation(content).restart();
        }
      });
    });
  };

  // アコーディオンが開くときのGSAPアニメーション
  const openAnimation = (content) =>
    gsap.fromTo(
      content,
      {
        height: 0,
      },
      {
        height: "auto",
        duration: 0.3,
        ease: "power2.out",
        overwrite: true,
      }
    );

  // アコーディオンが閉じるときのGSAPアニメーション
  const closeAnimation = (content, element) =>
    gsap.to(content, {
      height: 0,
      duration: 0.3,
      ease: "power2.out",
      overwrite: true,
      onComplete: () => {
        // アニメーションが完了したら open 属性を削除
        element.removeAttribute("open");
      },
    });

  accordionGsap();
}
