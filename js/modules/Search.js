import $ from "jquery";

class Search {
  // Section #1 the constructor is where we describe/create our object
  constructor() {
    this.openButton = $(".js-search-trigger");
    this.closeButton = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchTerm = $("#search-term");
    this.resultsDiv = $("#search-overlay__results");
    this.theDocument = $(document);
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.events();
    this.typingTimer;
  }
  // 2. events that we handle
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    this.theDocument.on("keydown", this.keyPressDispatcher.bind(this));
    this.searchTerm.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchTerm.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchTerm.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 1200);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchTerm.val();
  }

  getResults() {
    this.resultsDiv.html("this is a result");
    this.isSpinnerVisible = false;
  }

  keyPressDispatcher(e) {
    if (e.keyCode === 83 && !this.isOverlayOpen && !$("input, textarea").is(":focus")) {
      this.openOverlay();
    }
    if (e.keyCode === 27 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }
}

export default Search;
