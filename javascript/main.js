document.addEventListener("DOMContentLoaded", () => {
  const toggles = document.querySelectorAll('.menu-toggle');
  const sidebar = document.querySelector('.sidebar');
  const sidebar2 = document.querySelector('.sidebar2');
  
  toggles.forEach(toggle => { 
      toggle.addEventListener("click", () => {
          sidebar.classList.toggle('open');
          sidebar2.classList.toggle('open');
          if (sidebar.classList.contains('explore')) {
            sidebar.classList.remove('explore');
        }
        
          if (sidebar2.classList.contains('explore')) {
              sidebar2.classList.remove('explore');
          }
      });
  });
});



document.addEventListener("DOMContentLoaded", () => {
  const smallprofile = document.querySelector('.smallprofile');
  const profile = document.querySelector('.profile');

  smallprofile.addEventListener("click", () => {
    profile.classList.toggle('profopen');
  
  });
 
});
/*
document.addEventListener('scroll', function() {
  var navbar = document.querySelector('.slimheader');
  if (window.scrollY > 0) { // Adjust the scroll value as needed
      navbar.classList.add('scrolled'); // Change to transparent
  } else {
      navbar.classList.remove('scrolled'); // Change to opaque
  }
});*/

document.addEventListener('DOMContentLoaded', () => {
  const players = document.querySelectorAll('.music-player');

  players.forEach(player => {
    const audio = player.querySelector('.audio');
    const playBtn = player.querySelector('.play');
    const pauseBtn = player.querySelector('.pause');
    const stopBtn = player.querySelector('.stop');
    const playBtnSubmit = player.querySelector('button');
    const progressBar = player.querySelector('.progress-bar');
    const currentTimeEl = player.querySelector('.current-time');
    const durationEl = player.querySelector('.duration');

    // Play song
    function playSong() {
      playBtn.style.display = 'none';
      pauseBtn.style.display = 'block';

      if (audio.duration > 1){
        audio.play();
      }else{
        playBtnSubmit.click();
        audio.play();
      }
    }

    // Pause song
    function pauseSong() {
      audio.pause();
      playBtn.style.display = 'block';
      pauseBtn.style.display = 'none';
    }

    // Stop song
    function stopSong() {
      audio.pause();
      audio.currentTime = 0;
      progressBar.value = 0;
      currentTimeEl.innerText = '0:00';
      playBtn.style.display = 'block';
      pauseBtn.style.display = 'none';
    }

    // Update progress bar and time display
    function updateProgressBar() {
      const { duration, currentTime } = audio;
      progressBar.value = (currentTime / duration) * 100;
      currentTimeEl.innerText = formatTime(currentTime);
      durationEl.innerText = formatTime(duration);
    }

    // Set progress
    function setProgress(e) {
      const width = this.clientWidth;
      const clickX = e.offsetX;
      const duration = audio.duration;
      audio.currentTime = (clickX / width) * duration;
    }

    // Format time in MM:SS
    function formatTime(time) {
      const minutes = Math.floor(time / 60);
      const seconds = Math.floor(time % 60);
      return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    // Event listeners
    playBtn.addEventListener('click', playSong);
    pauseBtn.addEventListener('click', pauseSong);
    stopBtn.addEventListener('click', stopSong);
    audio.addEventListener('timeupdate', updateProgressBar);
    progressBar.addEventListener('click', setProgress);
  });
});

//save and remove post
document.addEventListener('DOMContentLoaded', () => {
  const cardbottom = document.querySelectorAll('.card-bottom');

  cardbottom.forEach(card => {
    const plusButton = card.querySelector('.fa-plus');
    const checkButton = card.querySelector('.fa-check');
    const savedButton = card.querySelector('button');

    //save Post
    function savePost(){
      plusButton.style.display = 'none';
      checkButton.style.display = 'block';
      savedButton.click();

    }
    
    //unsave Post
    function removePost(){
      plusButton.style.display = 'block';
      checkButton.style.display = 'none';
     
    }
    // Event Listeners
    plusButton.addEventListener('click', savePost);
    checkButton.addEventListener('click', removePost);
  });

});


document.addEventListener('DOMContentLoaded', () => {
  const genrebutton = document.querySelectorAll('.genre-button');

  genrebutton.forEach(button=>{
    button.parentElement.addEventListener('click',()=>{
      button.click();
    })
  })

});

document.addEventListener('DOMContentLoaded', () => {
  const explorebutton = document.querySelector('.globsidearrow');
  const sidebar = document.querySelector('.sidebar');
  const sidebar2 = document.querySelector('.sidebar2');

  explorebutton.addEventListener('click',() => {
    sidebar.classList.add('explore');
    sidebar2.classList.add('explore');
    sidebar.classList.add('open');
    sidebar2.classList.add('open');

  })

});


