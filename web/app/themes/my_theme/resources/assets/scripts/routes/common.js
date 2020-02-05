/* eslint-disable */

//import '../slidemenu/';

export default {
  init() {
    // JavaScript to be fired on all pages
    $(window).load(function() {
      $("body").removeClass("preload");

      $('.iav-footer-language-button').hover(function(){
        $(this).find('a').each(function(){
            $(this).toggleClass('active')
        }, function(){
            $(this).toggleClass('active')
        })   
      });

    });

    // Slidemenu
    $(window).load(function ($) {
      const PLUGIN_NAME = 'slideMenu';
      const DEFAULT_OPTIONS = {
          position: 'right',
          showBackLink: true,
          keycodeOpen: null,
          keycodeClose: 27, //esc
          submenuLinkBefore: '',
          submenuLinkAfter: '',
          backLinkBefore: '',
          backLinkAfter: '',
      }; 
  
      class SlideMenu {
        constructor(options) {
            this.options = options;
            this._menu = options.elem;
            // Add wrapper
            this._menu.find('ul:first').wrap('<div class="slider">');
            this._anchors = this._menu.find('a');
            this._slider = this._menu.find('.slider:first');
            this._level = 0;
            this._isOpen = false;
            this._isAnimating = false;
            this._hasMenu = this._anchors.length > 0;
            this._lastAction = null;
            this._setupEventHandlers();
            this._setupMenu();
            if (this._hasMenu)
            this._setupSubmenus();
          }
  
          /**
           * Toggle the menu
           * @param {boolean|null} open
           * @param {boolean} animate
           */
          toggle(open = null, animate = true) {
              let offset;
              if (open === null) {
                  if (this._isOpen) {
                      this.close();
                  } else {
                      this.open();
                  }
                  return;
              } else if (open) {
                  offset = 0;
                  this._isOpen = true;
              } else {
                  offset = (this.options.position === 'left') ? '-100%' : '100%';
                  this._isOpen = false;
              }
  
              this._triggerEvent();
              if (animate)
                this._triggerAnimation(this._menu, offset);
              else {
                this._pauseAnimations(this._triggerAnimation.bind(this, this._menu, offset));
                this._isAnimating = false;
            }
          }
  
          /**
           * Open the menu
           * @param {boolean} animate Use CSS transitions
           */
          open(animate = true) {
            this._lastAction = 'open';
            this.toggle(true, animate);
          }
  
          /**
           * Close the menu
           * @param {boolean} animate Use CSS transitions
           */
          close(animate = true) {
              this._lastAction = 'close';
              this.toggle(false, animate);
          }
  
          /**
           * Navigate one menu hierarchy back if possible
           */
          back() {
              this._lastAction = 'back';
              this._navigate(null, -1);
          }
  
          /**
           * Navigate to a specific link on any level (useful to open the correct hierarchy directly)
           * @param {string|object} target A string selector a plain DOM object or a jQuery instance
           */
          navigateTo(target) {
              target = this._menu.find($(target)).first();
              if (!target.length)
                  return false;
              var parents = target.parents('ul');
              var level = parents.length - 1;
              if (level === 0)
                  return false;
              this._pauseAnimations(() => {
                  this._level = level;
                  parents.show().first().addClass('slideractive');
                  this._triggerAnimation(this._slider, -this._level * 100);
              });
          }
  
          /**
           * Set up all event handlers
           * @private
           */
          _setupEventHandlers() {
              if (this._hasMenu) {
                  this._anchors.click((event) => {
                      let anchor = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a:first');
                      this._navigate(anchor);
                  });
              }
  
              $(this._menu.add(this._slider)).on('transitionend msTransitionEnd', () => {
                  this._isAnimating = false;
                  this._triggerEvent(true);
              });
  
              $(document).keydown((e) => {
                  switch(e.which) {
                      case this.options.keycodeClose:
                          this.close();
                          break;
  
                      case this.options.keycodeOpen:
                          this.open();
                          break;
  
                      default:
                          return;
                  }
                  e.preventDefault();
              });
  
              this._menu.on('sm.back-after', () => {
                  let lastActiveUl = 'ul ' + '.slideractive '.repeat(this._level + 1);
                  this._menu.find(lastActiveUl).removeClass('slideractive').hide();
              });
          }
  
          /**
           * Trigger a custom event to support callbacks
           * @param {boolean} afterAnimation Mark this event as `before` or `after` callback
           * @private
           */
          _triggerEvent(afterAnimation = false) {
              let eventName = 'sm.' + this._lastAction;
              if (afterAnimation) eventName += '-after';
              this._menu.trigger(eventName);
          }
  
          /**
           * Navigate the _menu - that is slide it one step left or right
           * @param {jQuery} anchor The clicked anchor or button element
           * @param {int} dir Navigation direction: 1 = forward, 0 = backwards
           * @private
           */
          _navigate(anchor, dir = 1) {
              // Abort if an animation is still running
              if (this._isAnimating) {
                  return;
              }
  
              let offset = (this._level + dir) * -100;
  
              if (dir > 0) {
                  if (!anchor.next('ul').length)
                      return;
  
                  anchor.next('ul').addClass('slideractive').show();
              } else if (this._level === 0) {
                  return;
              }
  
              this._lastAction = dir > 0 ? 'forward' : 'back';
              this._level = this._level + dir;
  
              this._triggerAnimation(this._slider, offset);
          }
  
          /**
           * Start the animation (the CSS transition)
           * @param elem
           * @param offset
           * @private
           */
          _triggerAnimation(elem, offset) {
              this._triggerEvent();
  
              if (!String(offset).includes('%'))
                  offset += '%';
  
              elem.css('transform', 'translateX(' + offset + ')');
              this._isAnimating = true;
          }
  
          /**
           * Initialize the menu
           * @private
           */
          _setupMenu() {
              this._pauseAnimations(() => {
                  switch (this.options.position) {
                      case 'left':
                          this._menu.css({
                              left: 0,
                              right: 'auto',
                              transform: 'translateX(-100%)'
                          });
                          break;
                      default:
                          this._menu.css({
                              left: 'auto',
                              right: 0,
                              transform: 'translateX(100%)'
                          });
                          break;
                  }
                  this._menu.show();
              });
          }
  
          /**
           * Pause the CSS transitions, to apply CSS changes directly without an animation
           * @param work
           * @private
           */
          _pauseAnimations(work) {
            this._menu.addClass('no-transition');
            work();
            this._menu[0].offsetHeight; // trigger a reflow, flushing the CSS changes
            this._menu.removeClass('no-transition');
          }
  
          /**
           * Enhance the markup of menu items which contain a submenu
           * @private
           */
          _setupSubmenus() {
              this._anchors.each((i, anchor) => {
                  anchor = $(anchor);
                  if (anchor.next('ul').length) {
                      // prevent default behaviour (use link just to navigate)
                      anchor.click(function (ev) {
                          ev.preventDefault();
                      });
  
                      // add `before` and `after` text
                      let anchorTitle = anchor.text();
                      anchor.html(this.options.submenuLinkBefore + anchorTitle + this.options.submenuLinkAfter);
  
                      // add a back button
                      if (this.options.showBackLink) {
                          let backLink = $('<a href class="slide-menu-control" data-action="back">' + anchorTitle + '</a>');
                          backLink.html(this.options.backLinkBefore + backLink.text() + this.options.backLinkAfter);
                          anchor.next('ul').prepend($('<li>').append(backLink));
                      }
                  }
              });
          }
      }
  
      // Link control buttons with the API
      $('body').on('click', '.slide-menu-control', function (e) {
          let menu;
          let target = $(this).data('target');
  
          if (!target || target === 'this') {
              menu = $(this).parents('.slide-menu:first');
          } else {
              menu = $('#' + target)
          }
  
          if (!menu.length) return;
  
          let instance = menu.data(PLUGIN_NAME);
          let action = $(this).data('action');
  
          if (instance && typeof instance[action] === 'function') {
              instance[action]();
          }
  
          return false;
      });
  
      // Register the jQuery plugin
      $.fn[PLUGIN_NAME] = function (options) {
          if (!$(this).length) {
              console.warn('Slide Menu: Unable to find menu DOM element. Maybe a typo?');
              return;
          }
          options = $.extend({}, DEFAULT_OPTIONS, options);
          options.elem = $(this);
          let instance = new SlideMenu(options);
          $(this).data(PLUGIN_NAME, instance);
          return instance;
      };

    
  }(jQuery));
  

    // JavaScript to be fired on all pages
    //console.log('I am a common script!!!');

    /*****  MAIN MENU: This is for the Large Menu to show the right list items when Clicking ******/ 
    /*setTimeout(
        function(){ */
            $('#menu-main-nav > .menu-item-has-children, #menu-main-nav-en > .menu-item-has-children').each(function(index) {
                // console.log('is main menu');
                // First we need to add the New Divs for all the other Elements to go inside
                const menuId = index;
                let leftCol = $(this).find('.left-col');
                leftCol.remove();
                let subMenuLevel2 = $(this).children('.sub-menu');
                subMenuLevel2.remove();
        
                // Now add the grid Classes
                leftCol.addClass('uk-width-1-3');
                // In the First Box which has to be blue make sure that the submenu has a class with width 2
                if(index === 0) {
                    subMenuLevel2.addClass('uk-width-2-3');
                } else {
                    subMenuLevel2.addClass('uk-width-1-3');
                }
        
                // Wenn Submenu weitere Submenus Hat, dann mache 2 Array
                // Eines mit dem linken Submenu des Ersten Levels und Toggle ID
                // Eines mit dem Rechten Submenus die je nach IDs getoggled werden
                let hasNrChild = subMenuLevel2.find('.menu-item-has-children').length;
        
                if(subMenuLevel2 && hasNrChild > 0) {
                    // console.log('has further sub menus');
                    // Loop through the Second Level and Find Items With Children
                    subMenuLevel2.find('.menu-item-has-children').each(function(i) {
                    let subMenusLevel3Array = [];
                    let subMenuLevel3;
                    // Here we construct a unique ID for Each Item
                    $(this).attr('data-id', i);
        
                    // We only expect one Submenu for Each Level 2 Li
                    if($(this).find('.sub-menu') && $(this).find('.sub-menu').length === 1) {
                        $(this).children('.sub-menu').hide();
                        // console.log($(this).children('.sub-menu'));
                        // These are the Right Menus
                        subMenuLevel3 = $(this).children('.sub-menu');
                        subMenuLevel3.addClass('sub-menu-level3 uk-width-1-3');
                        subMenuLevel3.attr('id', i);
        
                        // Now we attach a click event that grabs the submenu
                        // inserts it into the grid 
                        // and toggles the container
                        $(this).click(function(e) {
                        e.preventDefault();
                        // Remove any previously attached Items
                        let searchID = '#' + i;
                        //console.log(searchID, subMenuLevel3);
                        $(this).parent().parent().find('.sub-menu-level3').remove();
                        $(this).parent().after(subMenuLevel3); // insert the subMenuLevel3
                        $(this).parent().parent().find(searchID).show();
                        //console.log('clicked main menu');
                        });
                    }
                    })
                }
        
                const newDiv = '<div class="uk-navbar-dropdown uk-drop uk-drop-boundary uk-drop-bottom-center" uk-drop="boundary: .iav-navbar-container; mode: hover; delay-show: 200; delay-hide: 50; boundary-align: true; pos: bottom-justify;"><div class="uk-container"><div class="uk-grid" uk-grid><div class="uk-width-1-1"><button class="uk-drop-close uk-close-large iav-menu-drop-close uk-align-right" type="button" uk-close></button></div></div></div></div>';
                $(this).after(newDiv);
                $(this).next().find('.uk-grid').append(leftCol);
                $('#iav-navbar').css({'opacity' : 1}); 
                // Remove the Submenus inside the Level one Submenu
                subMenuLevel2.find('.sub-menu').remove();
                $(this).next().find('.uk-grid').append(subMenuLevel2);
                }); 
        /*}, 100); */
    },  // End INIT FUNCTION

    // JavaScript to be fired on all pages, after page specific JS is fired
    finalize() {
      /**** MOBILE MENU ******/ 
      // Clean the Menu and REMOVE LEFT COLS
      $('#slidemenu').find('.left-col').remove();
  
      // // Activate Slide Menu
      var slideMenu = $('#slidemenu').slideMenu();
/*       setTimeout(  */
        /* function(){ */
            $('#iav-mobile-close').click(function(){
                $(this).toggleClass('open');
            });
            
        /* }, 200); */
  
      //If the first child has class active and make the whole menu blue
      $('#slidemenu .menu-item-has-children').first().children('a').click(function(){
         // console.log('clicked', $(this), $(this).next('ul'));
          $(this).next('ul').addClass('bg-blue');
      });
  
      $('#slidemenu .menu-item-has-children').first().find('a.slide-menu-control').click(function(){
        if($(this).closest('.sub-menu').hasClass('bg-blue')) {
          $(this).closest('.sub-menu').removeClass('bg-blue');
        }
      });

      // Enable Body Scroll Lock
     /*  var hamburger = $('#iav-mobile-close');
      hamburger.click(function(e) {
        bodyScrollLock.clearAllBodyScrollLocks();
        if(hamburger.hasClass('open')) {
          console.log('open');
          e.preventDefault();
          const targetElement = $('#slidemenu');
          console.log(targetElement);
          const options = {
            reserveScrollBarGap: false,
          }
          bodyScrollLock.disableBodyScroll(targetElement, options); 
        } else {
          console.log('close');
          const targetElement = $('#slidemenu');
          console.log(targetElement);
          e.preventDefault();
          bodyScrollLock.enableBodyScroll(targetElement);
        }
      }) */

      (function(document, history, location) {
        var HISTORY_SUPPORT = !!(history && history.pushState);
      
        var anchorScrolls = {
          ANCHOR_REGEX: /^#[^ ]+$/,
          OFFSET_HEIGHT_PX: 260,
      
          /**
           * Establish events, and fix initial scroll position if a hash is provided.
           */
          init: function() {
            this.scrollToCurrent();
            $(window).on('hashchange', $.proxy(this, 'scrollToCurrent'));
            $('body').on('click', 'a', $.proxy(this, 'delegateAnchors'));
          },
      
          /**
           * Return the offset amount to deduct from the normal scroll position.
           * Modify as appropriate to allow for dynamic calculations
           */
          getFixedOffset: function() {
            return this.OFFSET_HEIGHT_PX;
          },
      
          /**
           * If the provided href is an anchor which resolves to an element on the
           * page, scroll to it.
           * @param  {String} href
           * @return {Boolean} - Was the href an anchor.
           */
          scrollIfAnchor: function(href, pushToHistory) {
            var match, anchorOffset;
      
            if(!this.ANCHOR_REGEX.test(href)) {
              return false;
            }
      
            match = document.getElementById(href.slice(1));
      
            if(match) {
              anchorOffset = $(match).offset().top - this.getFixedOffset();
              $('html, body').animate({ scrollTop: anchorOffset});
      
              // Add the state to history as-per normal anchor links
              if(HISTORY_SUPPORT && pushToHistory) {
                history.pushState({}, document.title, location.pathname + href);
              }
            }
      
            return !!match;
          },
          
          /**
           * Attempt to scroll to the current location's hash.
           */
          scrollToCurrent: function(e) { 
            if(this.scrollIfAnchor(window.location.hash) && e) {
                e.preventDefault();
            }
          },
      
          /**
           * If the click event's target was an anchor, fix the scroll position.
           */
          delegateAnchors: function(e) {
            var elem = e.target;
      
            if(this.scrollIfAnchor(elem.getAttribute('href'), true)) {
              e.preventDefault();
            }
          }
        };
      
          $(document).ready($.proxy(anchorScrolls, 'init'));
      })(window.document, window.history, window.location);
      


      /**** Prevent Jittering Event on Mouse Scroll with Background Image Fiexed IE11 - in the Parallax Module ******/ 
      if(navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/12\./)) {
        document.body.addEventListener("mousewheel", function() {
          event.preventDefault();
          var wd = event.wheelDelta;
          var csp = window.pageYOffset;
          window.scrollTo(0, csp - wd);
        });
      }
      
      function myFunc(arg) {
        //console.log(`arg was => ${arg}`);
        const bps = window.matchMedia( "(min-width: 767px)" );
          if ((window.location.href.indexOf("/make-the-world-more-mobile") > -1 || window.location.href.indexOf("/die-welt-mobiler-machen") > -1) && bps.matches) {
            //console.log("The URL contains careers-overview");
            $aivo.ready(function() {
                $aivo.chat.open();
            });
          }
          else {
            //console.log("Chatbot closed");
            $aivo.ready(function() {
              $aivo.chat.close();
            });
          }
        
      }
      setTimeout(myFunc, 1500, 'Hello IAV Chatbot');

    }, // End Finalize
}; // End Export Default
