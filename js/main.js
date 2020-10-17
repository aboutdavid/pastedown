  if (halfmoon.getPreferredMode() == "light-mode") {
    // Light mode is preferred
  }
  else if (halfmoon.getPreferredMode() == "dark-mode") {
    halfmoon.toggleDarkMode();
  }
  else if (halfmoon.getPreferredMode() == "not-set") {
    halfmoon.toggleDarkMode();
  }