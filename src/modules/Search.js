import $ from 'jquery'

class Search {
	// 1. and create/describe our object
	constructor() {
        this.resultsDiv = $("#search-overlay__results")
		this.openButton = $('.js-search-trigger')
		this.closeButton = $('.search-overlay__close')
		this.searchOverlay = $('.search-overlay')
		this.searchField = $('#search-term')
		this.events()
		this.isOverlayOpen = false
        this.typingTimer
        this.isSpinnerVisible = false
        this.previousValue;
	}
	// 2. events
	events() {
		this.openButton.on('click', this.openOverlay.bind(this))
		this.closeButton.on('click', this.closeOverlay.bind(this))
		$(document).on('keydown', this.keyPressDispatcher.bind(this))
		this.searchField.on('keyup', this.typingLogic.bind(this))
	}
	// 3. methods function, action...

	typingLogic() {
        if(this.searchField.val() != this.previousValue ){
            clearTimeout(this.typingTimer);

            if(this.searchField.val()){
                if(!this.isSpinnerVisible){
                    this.resultsDiv.html('<div class="spinner-loader"></div>')
                    this.isSpinnerVisible = true
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 2000);

            } else {
                this.resultsDiv.html('')
                this.isSpinnerVisible = false

            }
        }
 
        this.previousValue = this.searchField.val();
	}

    getResults(){
       
        $.getJSON('http://fictional-university.local/wp-json/wp/v2/posts?search='+ this.searchField.val(), posts => {
            

            this.resultsDiv.html(`
            <h2 class="search-overlay__section-title">General information</h2>
            <ul class="link-list min -list">
                ${posts.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
            </ul>
            `);

        });
    }

	openOverlay() {
		this.searchOverlay.addClass('search-overlay--active')
		$('body').addClass('body-no-scroll')
		this.isOverlayOpen = true
	}

	keyPressDispatcher(e) {
		if (e.keyCode == 83 && !this.isOverlayOpen && !$('input, textarea').is(':focus')) {
			this.openOverlay()
		}
		if (e.keyCode == 27 && this.isOverlayOpen) {
			this.closeOverlay()
		}
	}

	closeOverlay() {
		this.searchOverlay.addClass('search-overlay--active')
		$('body').removeClass('body-no-scroll')
		this.searchOverlay.removeClass('search-overlay--active')
		this.isOverlayOpen = false
	}
}

export default Search

