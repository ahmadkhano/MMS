// Scroll to top button start here
(function($) {
  "use strict"; // Start of use strict

  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();S
  });

})(jQuery); 
// Scroll to top button end here



// Dropdown script start here
document.addEventListener('DOMContentLoaded', function () {
  $('.dropdown-toggle').dropdown();

  const toggler = document.querySelector('.navbar-toggler');
  const navbarContent = document.querySelector('#navbarContent');

  toggler.addEventListener('click', function () {
    if (navbarContent.classList.contains('collapse')) {
      navbarContent.classList.remove('collapse');
    } else {
      navbarContent.classList.add('collapse');
    }
  });
});
// Dropdown script End here



// This script is for dataTables search, entries and more start here
$(document).ready(function () {
  var dataTableConfig = {
    language: {
      search: "تلاش لکھیں ",
      lengthMenu: "اندراجات _MENU_",
      info: "دکھائے جا رہے ہیں _START_ سے _END_ کے درمیان _TOTAL_ اندراجات",
      infoEmpty: "کوئی اندراج دستیاب نہیں",
      infoFiltered: "(کل _MAX_ اندراجات سے فلٹر کیا گیا)",
      paginate: {
        next: "اگلا",
        previous: "پچھلا"
      }
    },
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "More"]],  // Add 100+ option
    initComplete: function () {
      $('.dataTables_length').css('text-align', 'right');
      // $('.dataTables_paginate').css('bg-color', 'dark');
    }
  };

  for (var i = 1; i <= 13; i++) {
    var tableId = '#table' + i;

    if ($.fn.dataTable.isDataTable(tableId)) {
      $(tableId).DataTable().destroy();
    }

    var table = $(tableId).DataTable(dataTableConfig);

    $(tableId + '_length select').on('change', function () {
      var value = $(this).val();
      if (value === "100+") {
        table.page.len(-1).draw();  // Show all rows if 100+ is selected
      } else {
        table.page.len(value).draw();  // Show the selected number of rows
      }
    });
  }
});
// This script is for dataTables search, entries and more End here



// Grade-Page-Tabs Start Here
document.addEventListener("DOMContentLoaded", () => {
const tabToActivate = "home"; // Change to "home", "section", "section-in-grade", or "fees-in-grade"

if (tabToActivate === "home") {
  const homeTabTriggerEl = document.querySelector('#nav-home-tab');
  if (homeTabTriggerEl) {
    const homeTab = new bootstrap.Tab(homeTabTriggerEl);
    homeTab.show();
  }
} else if (tabToActivate === "section") {
  const sectionTabTriggerEl = document.querySelector('#nav-section-tab');
  if (sectionTabTriggerEl) {
    const sectionTab = new bootstrap.Tab(sectionTabTriggerEl);
    sectionTab.show();
  }
} else if (tabToActivate === "section-in-grade") {
  const sectionInGradeTabTriggerEl = document.querySelector('#nav-section-in-grade-tab');
  if (sectionInGradeTabTriggerEl) {
    const sectionInGradeTab = new bootstrap.Tab(sectionInGradeTabTriggerEl);
    sectionInGradeTab.show();
  }
}
else if (tabToActivate === "add-year") {
  const sectionInGradeTabTriggerEl = document.querySelector('#nav-add-year-tab');
  if (sectionInGradeTabTriggerEl) {
    const sectionInGradeTab = new bootstrap.Tab(sectionInGradeTabTriggerEl);
    sectionInGradeTab.show();
  }
} else if (tabToActivate === "fees-in-grade") {
  const feesInGradeTabTriggerEl = document.querySelector('#nav-fees-in-grade-tab');
  if (feesInGradeTabTriggerEl) {
    const feesInGradeTab = new bootstrap.Tab(feesInGradeTabTriggerEl);
    feesInGradeTab.show();
  }
}
});
// Grade-Page-Tabs End Here



// This script is for Subject-Tabs
document.addEventListener("DOMContentLoaded", () => {
const tabToActivate = "home"; // Change to "home", "section", "section-in-grade", or "fees-in-grade"

if (tabToActivate === "home") {
  const homeTabTriggerEl = document.querySelector('#nav-add-subject-tab');
  if (homeTabTriggerEl) {
    const homeTab = new bootstrap.Tab(homeTabTriggerEl);
    homeTab.show();
  }
} else if (tabToActivate === "add-year") {
    const sectionInGradeTabTriggerEl = document.querySelector('#nav-assign-subject-tab');
    if (sectionInGradeTabTriggerEl) {
      const sectionInGradeTab = new bootstrap.Tab(sectionInGradeTabTriggerEl);
      sectionInGradeTab.show();
    }
} 
});
// This script is for Subject-Tabs



// This script is for Exam Page Tabs
document.addEventListener("DOMContentLoaded", () => {
const tabToActivate = "add-exam-name";

if (tabToActivate === "add-exam-name") {
  const homeTabTriggerEl = document.querySelector('#nav-add-exam-name-tab');
  if (homeTabTriggerEl) {
    const homeTab = new bootstrap.Tab(homeTabTriggerEl);
    homeTab.show();
  }
} else if (tabToActivate === "add-datesheet") {
    const sectionTabTriggerEl = document.querySelector('#nav-add-datesheet-tab');
    if (sectionTabTriggerEl) {
      const sectionTab = new bootstrap.Tab(sectionTabTriggerEl);
      sectionTab.show();
    }
} else if (tabToActivate === "add-marks") {
    const sectionInGradeTabTriggerEl = document.querySelector('#nav-add-marks-tab');
    if (sectionInGradeTabTriggerEl) {
      const sectionInGradeTab = new bootstrap.Tab(sectionInGradeTabTriggerEl);
      sectionInGradeTab.show();
    }
}
});
// This script is for Exam Page Tabs



// This script is for dashboard background objects Animations
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("animated-background");
  
  if (!canvas) {
    console.error("Canvas element not found!");
    return; 
  }

  const ctx = canvas.getContext("2d");

  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const shapes = [];
  const colors = ["#FFD700", "#FF4500", "#1E90FF", "#ADFF2F", "#FF69B4"];

  function createShape() {
    const size = Math.random() * 30 + 10; // Random size between 10 and 30
    const x = Math.random() * canvas.width;
    const y = Math.random() * canvas.height;
    const dx = (Math.random() - 0.5) * 2; // Speed in x direction
    const dy = (Math.random() - 0.5) * 2; // Speed in y direction
    const color = colors[Math.floor(Math.random() * colors.length)];
    const type = ["circle", "square", "triangle"][Math.floor(Math.random() * 3)];
    return { x, y, dx, dy, size, color, type };
  }

  for (let i = 0; i < 50; i++) {
    shapes.push(createShape());
  }

  function drawShape(shape) {
    ctx.fillStyle = shape.color;

    if (shape.type === "circle") {
      ctx.beginPath();
      ctx.arc(shape.x, shape.y, shape.size / 2, 0, Math.PI * 2);
      ctx.fill();
      ctx.closePath();
    } else if (shape.type === "square") {
      ctx.fillRect(shape.x, shape.y, shape.size, shape.size);
    } else if (shape.type === "triangle") {
      ctx.beginPath();
      ctx.moveTo(shape.x, shape.y);
      ctx.lineTo(shape.x + shape.size, shape.y);
      ctx.lineTo(shape.x + shape.size / 2, shape.y - shape.size);
      ctx.closePath();
      ctx.fill();
    }
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas

    shapes.forEach((shape) => {
      drawShape(shape);

      shape.x += shape.dx;
      shape.y += shape.dy;

      if (shape.x < 0 || shape.x + shape.size > canvas.width) shape.dx *= -1;
      if (shape.y < 0 || shape.y + shape.size > canvas.height) shape.dy *= -1;
    });

    requestAnimationFrame(animate); // Keep animating
  }

  window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  });

  animate();
});
// This script is for dashboard background objects Animations


// This script is for night mode 
function toggleNightMode() {
  const body = document.body;
  const nightModeToggle = document.getElementById('nightModeToggle');

  body.classList.toggle('night-mode');

  const isNightMode = body.classList.contains('night-mode');
  if (isNightMode) {
      nightModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  } else {
      nightModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
  }

  localStorage.setItem('nightMode', isNightMode ? 'enabled' : 'disabled');
}

window.onload = function() {
  const nightMode = localStorage.getItem('nightMode');
  const nightModeToggle = document.getElementById('nightModeToggle');

  if (nightMode === 'enabled') {
      document.body.classList.add('night-mode');
      nightModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  }
};
// This script is for night mode 



// Another scripts