import.meta.glob(["../images/**"]);
import.meta.glob(["../videos/**"]);

function setupHeader() {
  const header = document.querySelector<HTMLElement>("header");
  const headerMainContent = document.querySelector<HTMLElement>(".h__main-content");

  if (!header || !headerMainContent) {
    return;
  }

  document.querySelectorAll(".js-toggle-mobile-menu").forEach((button) => {
    button.addEventListener("click", () => header.classList.toggle("opened"));
  });

  const updateHeaderHeight = () => {
    header.style.height = `${headerMainContent.getBoundingClientRect().height}px`;
  };

  updateHeaderHeight();
  window.addEventListener("resize", updateHeaderHeight);
}

if (document.readyState === "complete") {
  setupHeader();
} else {
  document.addEventListener("DOMContentLoaded", setupHeader, { once: true });
}
