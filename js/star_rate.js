function handleRating(event) {
    const stars = document.querySelectorAll('.rating label');
    const clickedStar = event.target.closest('label');

    if (clickedStar) {
        const clickedIndex = Array.from(stars).indexOf(clickedStar);
        for (let i = 0; i <= clickedIndex; i++) {
            stars[i].classList.add('selected');
        }
        for (let i = clickedIndex + 1; i < stars.length; i++) {
            stars[i].classList.remove('selected');
        }
    }
}