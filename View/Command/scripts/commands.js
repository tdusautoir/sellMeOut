var commands = document.querySelectorAll(".command-details");
var showDetails = document.querySelectorAll(".show-details");

for (let i = 0; i < showDetails.length; i++) {
  showDetails[i].addEventListener("click", function()
  {
    if (commands[i].style.display !== "flex") {
          commands[i].style.display = "flex";
          showDetails[i].classList.add("rotate");
        }else
        {
          commands[i].style.display = "none";
          showDetails[i].classList.remove("rotate");
        }
  });
}