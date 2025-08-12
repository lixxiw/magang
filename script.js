  const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const dots = document.querySelectorAll('.dot');

let currentIndex = 0;

function updateSlider() {
  slider.style.transform = `translateX(-${currentIndex * 100}%)`;
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentIndex);
  });
}
function showNextSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  updateSlider();
}

function showPrevSlide() {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  updateSlider();
}

nextButton.addEventListener('click', showNextSlide);
prevButton.addEventListener('click', showPrevSlide);

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    currentIndex = index;
    updateSlider();
  });
});

//------------------ Auto-slide every 5 seconds ------------------
setInterval(showNextSlide, 10000);

//------------------ Initialize slider ------------------
updateSlider();

document.querySelectorAll('.faq-question').forEach(item => {
  item.addEventListener('click', () => {
    item.classList.toggle('active');
    let answer = item.nextElementSibling;
    if (answer.style.display === 'block') {
      answer.style.display = 'none';
    } else {
        answer.style.display = 'block';
      }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const headerButtons = document.getElementById("headerButtons");

  window.addEventListener("scroll", () => {
    const scrollPosition = window.scrollY;

    // Add the "scrolled" class when the user scrolls more than 100px
    if (scrollPosition > 100) {
      headerButtons.classList.add("scrolled");
    } else {
      headerButtons.classList.remove("scrolled");
    }
  });
});
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const role = document.getElementById("role").value;
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const message = document.getElementById("message");

  // Dummy login data
  const credentials = {
    admin: { username: "admin123", password: "adminpass" },
    user: { username: "user123", password: "userpass" }
  };

  if (
    credentials[role] &&
    credentials[role].username === username &&
    credentials[role].password === password
  ) {
    message.style.color = "green";
    message.textContent = `Login ${role} berhasil!`;
    // Redirect atau tindakan lanjut bisa ditambahkan di sini
  } else {
    message.style.color = "red";
    message.textContent = "Username atau password salah.";
  }
});

