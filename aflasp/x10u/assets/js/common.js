$(function(){

  const $body = $('body');
  const $header = $('.header');
  const $headerMenu = $('.header__menu');
  const spMq = 768;
  let window_w = $(window).width();
  let window_h = $(window).height();
  let header_h = $header.height();
  let scrollTop = 0;

  $(window).on('load resize', function() {
    window_w = $(window).width();
    window_h = $(window).height();
    header_h = $header.height();
  });

  //function
  linkEasing();
  spMenu();
  object();
  tab();
  drop();
  copy();
  btnFilter();
  addrSearch();

  //link easing
  function linkEasing() {
    $('a[href^="#"]').on('click', function(){
      let link = $(this).attr('href');
      let target = $(link == "#" || link == "" ? 'html' : link);
      let header_h = $header.height();
      let position = target.offset().top - header_h;
      $('body, html').animate({
        scrollTop: position
      }, 500, 'swing');
      return false;
    });
  }

  //sp menu
  function spMenu() {
    $('.js-btn_gnaviMenu').on('click', function(){
      if($body.hasClass('is-gnaviMenu')) {
        $body.removeClass('is-gnaviMenu');
      } else {
        $body.addClass('is-gnaviMenu');
      }
      return false;
    });
  }

  // img object fit
  function object() {
    $('.ofi').each(function() {
      objectFitImages('.ofi');
    });
  }

  //tab
  function tab() {
    $('.js-tab_list .tab_item').on('click', function(){
      let $this = $(this);
      let $tabItem = $this.parents('.tab-style_table_area').find('.js-tab_list .tab_item');
      let $tabContent = $this.parents('.tab-style_table_area').find('.tab_content');
      let tabIndex = $(this).index();
      $tabItem.removeClass('is-active');
      $this.addClass('is-active');
      $tabContent.removeClass('.is-show').hide();
  		$tabContent.eq(tabIndex).fadeIn();
      console.log($tabItem);
      return false;
    });
  }

  //drop
  function drop() {
    $('.js-drop_btn').on('click', function(){
      let $this = $(this);
      let $dropContents = $this.parents().find('.drop_contents');
      if ($dropContents.hasClass('is-show')) {
        $this.removeClass('is-active');
        $dropContents.removeClass('is-show');
        $dropContents.slideUp();
      } else {
        $this.addClass('is-active');
        $dropContents.addClass('is-show');
        $dropContents.slideDown();
      }
      return false;
    });
  }

  //copy
  function copy() {
    $('.js-copy_btn').on('click', function(){
      let textElem = $(this).parent().find('.js-copy_text');
      window.getSelection().selectAllChildren(textElem[0]);
      document.execCommand("copy");
      return false;
    });
  }

  //btnFilter
  function btnFilter() {
    $('.js-btn-filter').on('click', function() {
      $(this).parent().find('.is-view').addClass('is-view');
      $(this).parent().find('.filter-cover').remove();
      $(this).remove();
    });
  }

  //住所検索
  function addrSearch() {
    $('.js-form__btn_addr').on('click', function() {
      AjaxZip3.zip2addr('zip', '', 'pref', 'addr');
      return false;
    });
  }

});
