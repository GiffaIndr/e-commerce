const panels = document.querySelectorAll(".panel");

panels.forEach((panel) => {
   panel.addEventListener("click", () => {
      removeActiveClasses();
      panel.classList.add("active");
   });
});

const removeActiveClasses = () => {
   panels.forEach((panel) => {
      panel.classList.remove("active");
   });
};
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});