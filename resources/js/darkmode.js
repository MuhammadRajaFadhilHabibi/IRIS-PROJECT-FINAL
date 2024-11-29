const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
          const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

          // Check and apply the theme based on previous settings
          if (localStorage.getItem('color-theme') === 'dark' || 
              (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
              document.documentElement.classList.add('dark');
              themeToggleLightIcon.classList.remove('hidden');
          } else {
              themeToggleDarkIcon.classList.remove('hidden');
          }

          const themeToggleBtn = document.getElementById('theme-toggle');

          // Event for dark mode toggle
          let event = new Event('dark-mode');

          themeToggleBtn.addEventListener('click', function() {

              // Toggle the icons
              themeToggleDarkIcon.classList.toggle('hidden');
              themeToggleLightIcon.classList.toggle('hidden');

              // Check the current theme and toggle it
              if (localStorage.getItem('color-theme') === 'light') {
                  document.documentElement.classList.add('dark');
                  localStorage.setItem('color-theme', 'dark'); // Save dark mode preference
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.setItem('color-theme', 'light'); // Save light mode preference
              }

              // Dispatch a custom event (if needed for other parts of your app)
              document.dispatchEvent(event);
          });