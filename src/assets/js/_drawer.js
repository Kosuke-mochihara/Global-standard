import { micromodal } from "micromodal";

export function drawer() {
  MicroModal.init();

  const buttons = document.querySelectorAll(".js-drawerButton");
  const header = document.getElementById("js-header");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const modal = button.nextElementSibling.id;
      const currentAriaExpanded = button.getAttribute("aria-expanded");

      if (currentAriaExpanded === "false") {
        button.setAttribute("aria-expanded", "true");
        MicroModal.show(modal, {
          disableScroll: true, // ページスクロールを無効に
          awaitOpenAnimation: true, // 開閉時のアニメーションを可能に
        });
        header.classList.add("is-open");
      } else {
        button.setAttribute("aria-expanded", "false");
        MicroModal.close(modal, {
          awaitCloseAnimation: true,
        });
        header.classList.remove("is-open");
      }
    });
  });
}