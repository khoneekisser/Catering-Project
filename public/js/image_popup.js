      document.addEventListener('DOMContentLoaded', (event) => {
          const thumbnails = document.querySelectorAll('.thumbnail');
          const imagePopup = document.getElementById('imagePopup');
          const popupImage = document.getElementById('popupImage');
  
          thumbnails.forEach(thumbnail => {
              thumbnail.addEventListener('mouseenter', function() {
                  const largeSrc = this.getAttribute('data-large');
                  popupImage.setAttribute('src', largeSrc);
  
                  const rect = this.getBoundingClientRect();
                  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                  const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
  
                  imagePopup.style.top = (rect.top + scrollTop - popupImage.offsetHeight - 10) + 'px'; // 10px gap
                  imagePopup.style.left = (rect.left + scrollLeft) + 'px';
  
                  imagePopup.style.display = 'block';
              });
  
              thumbnail.addEventListener('mouseleave', function() {
                  imagePopup.style.display = 'none';
              });
          });
  
          imagePopup.addEventListener('mouseenter', function() {
              imagePopup.style.display = 'block';
          });
  
          imagePopup.addEventListener('mouseleave', function() {
              imagePopup.style.display = 'none';
          });
      });
