

window.onload = () =>{

  const stars = document.querySelectorAll(".la-star");
  console.log(stars);

  const note = document.querySelector("#note");

  for (star of stars){
    star.addEventListener("mouseover",function(){
      resetStars();
      this.style.color = "orange";
      let previousStar = this.previousElementSibling;
      while(previousStar){
        previousStar.style.color = "orange";
        previousStar = previousStar.previousElementSibling;
      }
    });

    star.addEventListener("click",function(){
      note.value = this.dataset.value;
      console.log(note.value);
    });

  }

  function resetStars(){
    for (star of stars){
      star.style.color="black";
    }
  }
}
