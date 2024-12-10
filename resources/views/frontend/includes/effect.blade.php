 <!-- effect of himalayan honey -->

 <section class="container  pt-5">
  <div class="effectstart">
    <div class="titlebannnersection">
      <span class="d-flex flex-column justify-content-center align-items-center containertitle">
        <h2 class="d-flex justify-content-center">
          Effect of Himalayan Honey
        </h2>
        <div class="titlelongerbanner">
          <p class="titleline"></p>
          <span class="titlebannertext">SACRED HIMALAYAN HONEY</span>
          <p class="titleline"></p>
        </div>
      </span>
    </div>
    <div class="effectcontainer row align-items-center">
      <div class="effectimagecontainer col-md-4">
        <div class="slider">
          <img src="./image/homeheroimage.png" alt="" />
          <img src="./image/gallery/image/thirds.png" alt="" />
          <img src="./image/gallery/image/first.png" alt="" />
        </div>
      </div>
      <div class="effectcontentdescription col-md-8 ">
              <p class="commondescription">
          The effects of mad honey can vary for each individual. To assess your tolerance, start with a small amount, such as one tablespoon, and observe your body's response. If you experience no adverse effects, you may gradually increase the dosage if needed. We recommend not exceeding two tablespoons. For optimal results, consume mad honey on an empty stomach.
        </p>
        <p class="commondescription">
          <span class="pointhighlight">In Case of Overdose:</span>  Excessive intake may lead to digestive discomfort such as bloating or diarrhea. Allergic reactions, though rare, are possible for those sensitive to bee products. Due to its natural sugar content, excessive consumption may contribute to weight gain or blood sugar spikes.
           <p class="commondescription">
           <span class="pointhighlight">Dosage and Usage Guidelines: </span>Start with small amounts, such as a teaspoon daily, and adjust as needed based on individual health and dietary needs. Avoid giving honey to infants under one year old due to the risk of botulism.
        </p>
         <p class="commondescription">
          <span class="pointhighlight"> Caution:</span> Monitor intake to avoid negative effects and consult a healthcare provider for specific health concerns or conditions, especially for those with diabetes or allergies.
        </p>
      </div>
    </div>
  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    const slides = slider.querySelectorAll("img");
    const contentDescription = document.querySelector(
      ".effectcontentdescription"
    );
    let slideIndex = 0;

    // Show the first slide and content initially
    slides[slideIndex].classList.add("active");
    contentDescription.classList.add("active");

    // Set interval for image sliding
    setInterval(nextSlide, 3000); // Change slide every 3 seconds

    function nextSlide() {
      // Hide the current slide and content
      slides[slideIndex].classList.remove("active");
      contentDescription.classList.remove("active");

      slideIndex++;
      if (slideIndex >= slides.length) {
        slideIndex = 0;
      }

      // Show the next slide and content with animation
      slides[slideIndex].classList.add("active");
      contentDescription.classList.add("active");
    }
  });
</script>