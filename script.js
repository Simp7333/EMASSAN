const track = document.getElementById('carousel-track');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    const items = document.querySelectorAll('.carousel-item');
    const itemWidth = items[0].offsetWidth + 20; // item + margin

    let position = 0;

    prevButton.addEventListener('click', () => {
      if (position < 0) {
        position += itemWidth;
        track.style.transform = `translateX(${position}px)`;
      } 
    });

    nextButton.addEventListener('click', () => {
      const maxScroll = -(itemWidth * (items.length - Math.floor(track.parentElement.offsetWidth / itemWidth)));
      if (position > maxScroll) {
        position -= itemWidth;
        track.style.transform = `translateX(${position}px)`;
      }
    });