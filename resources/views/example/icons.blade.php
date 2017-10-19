@extends('example.layouts.dashboard')

@section('page_heading','Icons')

@section('section')

    <div class="col-lg-12">
        @component('example.widgets.panel')
            @slot ('panelTitle','Icons')
            @slot ('panelBody')
                <div class="row">
                    <div class="fa col-lg-3">
                        <p>@include('example.widgets.icon', array('class'=>'glass')) fa-glass

                        <p>@include('example.widgets.icon', array('class'=>'music')) fa-music

                        <p>@include('example.widgets.icon', array('class'=>'search')) fa-search

                        <p>@include('example.widgets.icon', array('class'=>'envelope-o')) fa-envelope-o

                        <p>@include('example.widgets.icon', array('class'=>'heart')) fa-heart

                        <p>@include('example.widgets.icon', array('class'=>'star')) fa-star

                        <p>@include('example.widgets.icon', array('class'=>'star-o')) fa-star-o

                        <p>@include('example.widgets.icon', array('class'=>'user')) fa-user

                        <p>@include('example.widgets.icon', array('class'=>'film')) fa-film

                        <p>@include('example.widgets.icon', array('class'=>'th-large')) fa-th-large

                        <p>@include('example.widgets.icon', array('class'=>'th')) fa-th

                        <p>@include('example.widgets.icon', array('class'=>'th-list')) fa-th-list

                        <p>@include('example.widgets.icon', array('class'=>'check')) fa-check

                        <p>@include('example.widgets.icon', array('class'=>'times')) fa-times

                        <p>@include('example.widgets.icon', array('class'=>'search-plus')) fa-search-plus

                        <p>@include('example.widgets.icon', array('class'=>'search-minus')) fa-search-minus

                        <p>@include('example.widgets.icon', array('class'=>'power-off')) fa-power-off

                        <p>@include('example.widgets.icon', array('class'=>'signal')) fa-signal

                        <p>@include('example.widgets.icon', array('class'=>'gear')) fa-gear

                        <p>@include('example.widgets.icon', array('class'=>'cog')) fa-cog

                        <p>@include('example.widgets.icon', array('class'=>'trash-o')) fa-trash-o

                        <p>@include('example.widgets.icon', array('class'=>'home')) fa-home

                        <p>@include('example.widgets.icon', array('class'=>'file-o')) fa-file-o

                        <p>@include('example.widgets.icon', array('class'=>'clock-o')) fa-clock-o

                        <p>@include('example.widgets.icon', array('class'=>'road')) fa-road

                        <p>@include('example.widgets.icon', array('class'=>'download')) fa-download

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-o-down'))
                            fa-arrow-circle-o-down

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-o-up'))
                            fa-arrow-circle-o-up

                        <p>@include('example.widgets.icon', array('class'=>'inbox')) fa-inbox

                        <p>@include('example.widgets.icon', array('class'=>'play-circle-o')) fa-play-circle-o

                        <p>@include('example.widgets.icon', array('class'=>'rotate-right')) fa-rotate-right

                        <p>@include('example.widgets.icon', array('class'=>'repeat')) fa-repeat

                        <p>@include('example.widgets.icon', array('class'=>'refresh')) fa-refresh

                        <p>@include('example.widgets.icon', array('class'=>'list-alt')) fa-list-alt

                        <p>@include('example.widgets.icon', array('class'=>'lock')) fa-lock

                        <p>@include('example.widgets.icon', array('class'=>'flag')) fa-flag

                        <p>@include('example.widgets.icon', array('class'=>'headphones')) fa-headphones

                        <p>@include('example.widgets.icon', array('class'=>'volume-off')) fa-volume-off

                        <p>@include('example.widgets.icon', array('class'=>'volume-down')) fa-volume-down

                        <p>@include('example.widgets.icon', array('class'=>'volume-up')) fa-volume-up

                        <p>@include('example.widgets.icon', array('class'=>'qrcode')) fa-qrcode

                        <p>@include('example.widgets.icon', array('class'=>'barcode')) fa-barcode

                        <p>@include('example.widgets.icon', array('class'=>'tag')) fa-tag

                        <p>@include('example.widgets.icon', array('class'=>'tags')) fa-tags

                        <p>@include('example.widgets.icon', array('class'=>'book')) fa-book

                        <p>@include('example.widgets.icon', array('class'=>'bookmark')) fa-bookmark

                        <p>@include('example.widgets.icon', array('class'=>'print')) fa-print

                        <p>@include('example.widgets.icon', array('class'=>'camera')) fa-camera

                        <p>@include('example.widgets.icon', array('class'=>'font')) fa-font

                        <p>@include('example.widgets.icon', array('class'=>'bold')) fa-bold

                        <p>@include('example.widgets.icon', array('class'=>'italic')) fa-italic

                        <p>@include('example.widgets.icon', array('class'=>'text-height')) fa-text-height

                        <p>@include('example.widgets.icon', array('class'=>'text-width')) fa-text-width

                        <p>@include('example.widgets.icon', array('class'=>'align-left')) fa-align-left

                        <p>@include('example.widgets.icon', array('class'=>'align-center')) fa-align-center

                        <p>@include('example.widgets.icon', array('class'=>'align-right')) fa-align-right

                        <p>@include('example.widgets.icon', array('class'=>'align-justify')) fa-align-justify

                        <p>@include('example.widgets.icon', array('class'=>'list')) fa-list

                        <p>@include('example.widgets.icon', array('class'=>'dedent')) fa-dedent

                        <p>@include('example.widgets.icon', array('class'=>'outdent')) fa-outdent

                        <p>@include('example.widgets.icon', array('class'=>'indent')) fa-indent

                        <p>@include('example.widgets.icon', array('class'=>'video-camera')) fa-video-camera

                        <p>@include('example.widgets.icon', array('class'=>'photo')) fa-photo

                        <p>@include('example.widgets.icon', array('class'=>'image')) fa-image

                        <p>@include('example.widgets.icon', array('class'=>'picture-o')) fa-picture-o

                        <p>@include('example.widgets.icon', array('class'=>'pencil')) fa-pencil

                        <p>@include('example.widgets.icon', array('class'=>'map-marker')) fa-map-marker

                        <p>@include('example.widgets.icon', array('class'=>'adjust')) fa-adjust

                        <p>@include('example.widgets.icon', array('class'=>'tint')) fa-tint

                        <p>@include('example.widgets.icon', array('class'=>'edit')) fa-edit

                        <p>@include('example.widgets.icon', array('class'=>'pencil-square-o')) fa-pencil-square-o

                        <p>@include('example.widgets.icon', array('class'=>'share-square-o')) fa-share-square-o

                        <p>@include('example.widgets.icon', array('class'=>'check-square-o')) fa-check-square-o

                        <p>@include('example.widgets.icon', array('class'=>'arrows')) fa-arrows

                        <p>@include('example.widgets.icon', array('class'=>'step-backward')) fa-step-backward

                        <p>@include('example.widgets.icon', array('class'=>'fast-backward')) fa-fast-backward

                        <p>@include('example.widgets.icon', array('class'=>'backward')) fa-backward

                        <p>@include('example.widgets.icon', array('class'=>'play')) fa-play

                        <p>@include('example.widgets.icon', array('class'=>'pause')) fa-pause

                        <p>@include('example.widgets.icon', array('class'=>'stop')) fa-stop

                        <p>@include('example.widgets.icon', array('class'=>'forward')) fa-forward

                        <p>@include('example.widgets.icon', array('class'=>'fast-forward')) fa-fast-forward

                        <p>@include('example.widgets.icon', array('class'=>'step-forward')) fa-step-forward

                        <p>@include('example.widgets.icon', array('class'=>'eject')) fa-eject

                        <p>@include('example.widgets.icon', array('class'=>'chevron-left')) fa-chevron-left

                        <p>@include('example.widgets.icon', array('class'=>'chevron-right')) fa-chevron-right

                        <p>@include('example.widgets.icon', array('class'=>'plus-circle')) fa-plus-circle

                        <p>@include('example.widgets.icon', array('class'=>'minus-circle')) fa-minus-circle

                        <p>@include('example.widgets.icon', array('class'=>'times-circle')) fa-times-circle

                        <p>@include('example.widgets.icon', array('class'=>'check-circle')) fa-check-circle

                        <p>@include('example.widgets.icon', array('class'=>'question-circle')) fa-question-circle

                        <p>@include('example.widgets.icon', array('class'=>'info-circle')) fa-info-circle

                        <p>@include('example.widgets.icon', array('class'=>'crosshairs')) fa-crosshairs

                        <p>@include('example.widgets.icon', array('class'=>'times-circle-o')) fa-times-circle-o

                        <p>@include('example.widgets.icon', array('class'=>'check-circle-o')) fa-check-circle-o

                        <p>@include('example.widgets.icon', array('class'=>'ban')) fa-ban

                        <p>@include('example.widgets.icon', array('class'=>'arrow-left')) fa-arrow-left

                        <p>@include('example.widgets.icon', array('class'=>'arrow-right')) fa-arrow-right

                        <p>@include('example.widgets.icon', array('class'=>'arrow-up')) fa-arrow-up

                        <p>@include('example.widgets.icon', array('class'=>'arrow-down')) fa-arrow-down

                        <p>@include('example.widgets.icon', array('class'=>'mail-forward')) fa-mail-forward

                        <p>@include('example.widgets.icon', array('class'=>'share')) fa-share

                        <p>@include('example.widgets.icon', array('class'=>'expand')) fa-expand

                        <p>@include('example.widgets.icon', array('class'=>'compress')) fa-compress

                        <p>@include('example.widgets.icon', array('class'=>'plus')) fa-plus

                        <p>@include('example.widgets.icon', array('class'=>'minus')) fa-minus

                        <p>@include('example.widgets.icon', array('class'=>'asterisk')) fa-asterisk

                        <p>@include('example.widgets.icon', array('class'=>'exclamation-circle'))
                            fa-exclamation-circle

                        <p>@include('example.widgets.icon', array('class'=>'gift')) fa-gift

                        <p>@include('example.widgets.icon', array('class'=>'leaf')) fa-leaf

                        <p>@include('example.widgets.icon', array('class'=>'fire')) fa-fire

                        <p>@include('example.widgets.icon', array('class'=>'eye')) fa-eye

                        <p>@include('example.widgets.icon', array('class'=>'eye-slash')) fa-eye-slash

                        <p>@include('example.widgets.icon', array('class'=>'warning')) fa-warning

                        <p>@include('example.widgets.icon', array('class'=>'exclamation-triangle'))
                            fa-exclamation-triangle

                        <p>@include('example.widgets.icon', array('class'=>'plane')) fa-plane

                        <p>@include('example.widgets.icon', array('class'=>'calendar')) fa-calendar

                        <p>@include('example.widgets.icon', array('class'=>'random')) fa-random

                        <p>@include('example.widgets.icon', array('class'=>'comment')) fa-comment

                        <p>@include('example.widgets.icon', array('class'=>'magnet')) fa-magnet

                        <p>@include('example.widgets.icon', array('class'=>'chevron-up')) fa-chevron-up

                        <p>@include('example.widgets.icon', array('class'=>'chevron-down')) fa-chevron-down

                        <p>@include('example.widgets.icon', array('class'=>'retweet')) fa-retweet

                        <p>@include('example.widgets.icon', array('class'=>'shopping-cart')) fa-shopping-cart

                        <p>@include('example.widgets.icon', array('class'=>'folder')) fa-folder

                        <p>@include('example.widgets.icon', array('class'=>'folder-open')) fa-folder-open
                    </div>
                    <div class="fa col-lg-3">
                        <p>@include('example.widgets.icon', array('class'=>'arrows-v')) fa-arrows-v

                        <p>@include('example.widgets.icon', array('class'=>'arrows-h')) fa-arrows-h

                        <p>@include('example.widgets.icon', array('class'=>'bar-chart-o')) fa-bar-chart-o

                        <p>@include('example.widgets.icon', array('class'=>'twitter-square')) fa-twitter-square

                        <p>@include('example.widgets.icon', array('class'=>'facebook-square')) fa-facebook-square

                        <p>@include('example.widgets.icon', array('class'=>'camera-retro')) fa-camera-retro

                        <p>@include('example.widgets.icon', array('class'=>'key')) fa-key

                        <p>@include('example.widgets.icon', array('class'=>'gears')) fa-gears

                        <p>@include('example.widgets.icon', array('class'=>'cogs')) fa-cogs

                        <p>@include('example.widgets.icon', array('class'=>'comments')) fa-comments

                        <p>@include('example.widgets.icon', array('class'=>'thumbs-o-up')) fa-thumbs-o-up

                        <p>@include('example.widgets.icon', array('class'=>'thumbs-o-down')) fa-thumbs-o-down

                        <p>@include('example.widgets.icon', array('class'=>'star-half')) fa-star-half

                        <p>@include('example.widgets.icon', array('class'=>'heart-o')) fa-heart-o

                        <p>@include('example.widgets.icon', array('class'=>'sign-out')) fa-sign-out

                        <p>@include('example.widgets.icon', array('class'=>'linkedin-square')) fa-linkedin-square

                        <p>@include('example.widgets.icon', array('class'=>'thumb-tack')) fa-thumb-tack

                        <p>@include('example.widgets.icon', array('class'=>'external-link')) fa-external-link

                        <p>@include('example.widgets.icon', array('class'=>'sign-in')) fa-sign-in

                        <p>@include('example.widgets.icon', array('class'=>'trophy')) fa-trophy

                        <p>@include('example.widgets.icon', array('class'=>'github-square')) fa-github-square

                        <p>@include('example.widgets.icon', array('class'=>'upload')) fa-upload

                        <p>@include('example.widgets.icon', array('class'=>'lemon-o')) fa-lemon-o

                        <p>@include('example.widgets.icon', array('class'=>'phone')) fa-phone

                        <p>@include('example.widgets.icon', array('class'=>'square-o')) fa-square-o

                        <p>@include('example.widgets.icon', array('class'=>'bookmark-o')) fa-bookmark-o

                        <p>@include('example.widgets.icon', array('class'=>'phone-square')) fa-phone-square

                        <p>@include('example.widgets.icon', array('class'=>'twitter')) fa-twitter

                        <p>@include('example.widgets.icon', array('class'=>'facebook')) fa-facebook

                        <p>@include('example.widgets.icon', array('class'=>'github')) fa-github

                        <p>@include('example.widgets.icon', array('class'=>'unlock')) fa-unlock

                        <p>@include('example.widgets.icon', array('class'=>'credit-card')) fa-credit-card

                        <p>@include('example.widgets.icon', array('class'=>'rss')) fa-rss

                        <p>@include('example.widgets.icon', array('class'=>'hdd-o')) fa-hdd-o

                        <p>@include('example.widgets.icon', array('class'=>'bullhorn')) fa-bullhorn

                        <p>@include('example.widgets.icon', array('class'=>'bell')) fa-bell

                        <p>@include('example.widgets.icon', array('class'=>'certificate')) fa-certificate

                        <p>@include('example.widgets.icon', array('class'=>'hand-o-right')) fa-hand-o-right

                        <p>@include('example.widgets.icon', array('class'=>'hand-o-left')) fa-hand-o-left

                        <p>@include('example.widgets.icon', array('class'=>'hand-o-up')) fa-hand-o-up

                        <p>@include('example.widgets.icon', array('class'=>'hand-o-down')) fa-hand-o-down

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-left'))
                            fa-arrow-circle-left

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-right'))
                            fa-arrow-circle-right

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-up')) fa-arrow-circle-up

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-down'))
                            fa-arrow-circle-down

                        <p>@include('example.widgets.icon', array('class'=>'globe')) fa-globe

                        <p>@include('example.widgets.icon', array('class'=>'wrench')) fa-wrench

                        <p>@include('example.widgets.icon', array('class'=>'tasks')) fa-tasks

                        <p>@include('example.widgets.icon', array('class'=>'filter')) fa-filter

                        <p>@include('example.widgets.icon', array('class'=>'brifiase')) fa-brifiase

                        <p>@include('example.widgets.icon', array('class'=>'arrows-alt')) fa-arrows-alt

                        <p>@include('example.widgets.icon', array('class'=>'group')) fa-group

                        <p>@include('example.widgets.icon', array('class'=>'users')) fa-users

                        <p>@include('example.widgets.icon', array('class'=>'chain')) fa-chain

                        <p>@include('example.widgets.icon', array('class'=>'link')) fa-link

                        <p>@include('example.widgets.icon', array('class'=>'cloud')) fa-cloud

                        <p>@include('example.widgets.icon', array('class'=>'flask')) fa-flask

                        <p>@include('example.widgets.icon', array('class'=>'cut')) fa-cut

                        <p>@include('example.widgets.icon', array('class'=>'scissors')) fa-scissors

                        <p>@include('example.widgets.icon', array('class'=>'copy')) fa-copy

                        <p>@include('example.widgets.icon', array('class'=>'files-o')) fa-files-o

                        <p>@include('example.widgets.icon', array('class'=>'paperclip')) fa-paperclip

                        <p>@include('example.widgets.icon', array('class'=>'save')) fa-save

                        <p>@include('example.widgets.icon', array('class'=>'floppy-o')) fa-floppy-o

                        <p>@include('example.widgets.icon', array('class'=>'square')) fa-square

                        <p>@include('example.widgets.icon', array('class'=>'navicon')) fa-navicon

                        <p>@include('example.widgets.icon', array('class'=>'reorder')) fa-reorder

                        <p>@include('example.widgets.icon', array('class'=>'bars')) fa-bars

                        <p>@include('example.widgets.icon', array('class'=>'list-ul')) fa-list-ul

                        <p>@include('example.widgets.icon', array('class'=>'list-ol')) fa-list-ol

                        <p>@include('example.widgets.icon', array('class'=>'strikethrough')) fa-strikethrough

                        <p>@include('example.widgets.icon', array('class'=>'underline')) fa-underline

                        <p>@include('example.widgets.icon', array('class'=>'table')) fa-table

                        <p>@include('example.widgets.icon', array('class'=>'magic')) fa-magic

                        <p>@include('example.widgets.icon', array('class'=>'truck')) fa-truck

                        <p>@include('example.widgets.icon', array('class'=>'pinterest')) fa-pinterest

                        <p>@include('example.widgets.icon', array('class'=>'pinterest-square'))
                            fa-pinterest-square

                        <p>@include('example.widgets.icon', array('class'=>'google-plus-square'))
                            fa-google-plus-square

                        <p>@include('example.widgets.icon', array('class'=>'google-plus')) fa-google-plus

                        <p>@include('example.widgets.icon', array('class'=>'money')) fa-money

                        <p>@include('example.widgets.icon', array('class'=>'caret-down')) fa-caret-down

                        <p>@include('example.widgets.icon', array('class'=>'caret-up')) fa-caret-up

                        <p>@include('example.widgets.icon', array('class'=>'caret-left')) fa-caret-left

                        <p>@include('example.widgets.icon', array('class'=>'caret-right')) fa-caret-right

                        <p>@include('example.widgets.icon', array('class'=>'columns')) fa-columns

                        <p>@include('example.widgets.icon', array('class'=>'unsorted')) fa-unsorted

                        <p>@include('example.widgets.icon', array('class'=>'sort')) fa-sort

                        <p>@include('example.widgets.icon', array('class'=>'sort-down')) fa-sort-down

                        <p>@include('example.widgets.icon', array('class'=>'sort-desc')) fa-sort-desc

                        <p>@include('example.widgets.icon', array('class'=>'sort-up')) fa-sort-up

                        <p>@include('example.widgets.icon', array('class'=>'sort-asc')) fa-sort-asc

                        <p>@include('example.widgets.icon', array('class'=>'envelope')) fa-envelope

                        <p>@include('example.widgets.icon', array('class'=>'linkedin')) fa-linkedin

                        <p>@include('example.widgets.icon', array('class'=>'rotate-left')) fa-rotate-left

                        <p>@include('example.widgets.icon', array('class'=>'undo')) fa-undo

                        <p>@include('example.widgets.icon', array('class'=>'legal')) fa-legal

                        <p>@include('example.widgets.icon', array('class'=>'gavel')) fa-gavel

                        <p>@include('example.widgets.icon', array('class'=>'dashboard')) fa-dashboard

                        <p>@include('example.widgets.icon', array('class'=>'tachometer')) fa-tachometer

                        <p>@include('example.widgets.icon', array('class'=>'comment-o')) fa-comment-o

                        <p>@include('example.widgets.icon', array('class'=>'comments-o')) fa-comments-o

                        <p>@include('example.widgets.icon', array('class'=>'flash')) fa-flash

                        <p>@include('example.widgets.icon', array('class'=>'bolt')) fa-bolt

                        <p>@include('example.widgets.icon', array('class'=>'sitemap')) fa-sitemap

                        <p>@include('example.widgets.icon', array('class'=>'mbreli')) fa-umbreli

                        <p>@include('example.widgets.icon', array('class'=>'paste')) fa-paste

                        <p>@include('example.widgets.icon', array('class'=>'clipboard')) fa-clipboard

                        <p>@include('example.widgets.icon', array('class'=>'lightbulb-o')) fa-lightbulb-o

                        <p>@include('example.widgets.icon', array('class'=>'exchange')) fa-exchange

                        <p>@include('example.widgets.icon', array('class'=>'cloud-download')) fa-cloud-download

                        <p>@include('example.widgets.icon', array('class'=>'cloud-upload')) fa-cloud-upload

                        <p>@include('example.widgets.icon', array('class'=>'user-md')) fa-user-md

                        <p>@include('example.widgets.icon', array('class'=>'stethoscope')) fa-stethoscope

                        <p>@include('example.widgets.icon', array('class'=>'suitcase')) fa-suitcase

                        <p>@include('example.widgets.icon', array('class'=>'bell-o')) fa-bell-o

                        <p>@include('example.widgets.icon', array('class'=>'coffee')) fa-coffee

                        <p>@include('example.widgets.icon', array('class'=>'cutlery')) fa-cutlery

                        <p>@include('example.widgets.icon', array('class'=>'file-text-o')) fa-file-text-o

                        <p>@include('example.widgets.icon', array('class'=>'building-o')) fa-building-o

                        <p>@include('example.widgets.icon', array('class'=>'hospital-o')) fa-hospital-o

                        <p>@include('example.widgets.icon', array('class'=>'ambulance')) fa-ambulance

                        <p>@include('example.widgets.icon', array('class'=>'medkit')) fa-medkit

                        <p>@include('example.widgets.icon', array('class'=>'fighter-jet')) fa-fighter-jet

                        <p>@include('example.widgets.icon', array('class'=>'beer')) fa-beer

                        <p>@include('example.widgets.icon', array('class'=>'h-square')) fa-h-square

                        <p>@include('example.widgets.icon', array('class'=>'plus-square')) fa-plus-square
                    </div>
                    <div class="fa col-lg-3">
                        <p>@include('example.widgets.icon', array('class'=>'angle-double-left'))
                            fa-angle-double-left

                        <p>@include('example.widgets.icon', array('class'=>'angle-double-right'))
                            fa-angle-double-right

                        <p>@include('example.widgets.icon', array('class'=>'angle-double-up')) fa-angle-double-up

                        <p>@include('example.widgets.icon', array('class'=>'angle-double-down'))
                            fa-angle-double-down

                        <p>@include('example.widgets.icon', array('class'=>'angle-left')) fa-angle-left

                        <p>@include('example.widgets.icon', array('class'=>'angle-right')) fa-angle-right

                        <p>@include('example.widgets.icon', array('class'=>'angle-up')) fa-angle-up

                        <p>@include('example.widgets.icon', array('class'=>'angle-down')) fa-angle-down

                        <p>@include('example.widgets.icon', array('class'=>'desktop')) fa-desktop

                        <p>@include('example.widgets.icon', array('class'=>'laptop')) fa-laptop

                        <p>@include('example.widgets.icon', array('class'=>'tablet')) fa-tablet

                        <p>@include('example.widgets.icon', array('class'=>'mobile-phone')) fa-mobile-phone

                        <p>@include('example.widgets.icon', array('class'=>'mobile')) fa-mobile

                        <p>@include('example.widgets.icon', array('class'=>'circle-o')) fa-circle-o

                        <p>@include('example.widgets.icon', array('class'=>'quote-left')) fa-quote-left

                        <p>@include('example.widgets.icon', array('class'=>'quote-right')) fa-quote-right

                        <p>@include('example.widgets.icon', array('class'=>'spinner')) fa-spinner

                        <p>@include('example.widgets.icon', array('class'=>'circle')) fa-circle

                        <p>@include('example.widgets.icon', array('class'=>'mail-reply')) fa-mail-reply

                        <p>@include('example.widgets.icon', array('class'=>'reply')) fa-reply

                        <p>@include('example.widgets.icon', array('class'=>'github-alt')) fa-github-alt

                        <p>@include('example.widgets.icon', array('class'=>'folder-o')) fa-folder-o

                        <p>@include('example.widgets.icon', array('class'=>'folder-open-o')) fa-folder-open-o

                        <p>@include('example.widgets.icon', array('class'=>'smile-o')) fa-smile-o

                        <p>@include('example.widgets.icon', array('class'=>'frown-o')) fa-frown-o

                        <p>@include('example.widgets.icon', array('class'=>'meh-o')) fa-meh-o

                        <p>@include('example.widgets.icon', array('class'=>'gamepad')) fa-gamepad

                        <p>@include('example.widgets.icon', array('class'=>'keyboard-o')) fa-keyboard-o

                        <p>@include('example.widgets.icon', array('class'=>'flag-o')) fa-flag-o

                        <p>@include('example.widgets.icon', array('class'=>'flag-checkered')) fa-flag-checkered

                        <p>@include('example.widgets.icon', array('class'=>'terminal')) fa-terminal

                        <p>@include('example.widgets.icon', array('class'=>'code')) fa-code

                        <p>@include('example.widgets.icon', array('class'=>'mail-reply-all')) fa-mail-reply-all

                        <p>@include('example.widgets.icon', array('class'=>'reply-all')) fa-reply-all

                        <p>@include('example.widgets.icon', array('class'=>'star-half-empty')) fa-star-half-empty

                        <p>@include('example.widgets.icon', array('class'=>'star-half-full')) fa-star-half-full

                        <p>@include('example.widgets.icon', array('class'=>'star-half-o')) fa-star-half-o

                        <p>@include('example.widgets.icon', array('class'=>'location-arrow')) fa-location-arrow

                        <p>@include('example.widgets.icon', array('class'=>'crop')) fa-crop

                        <p>@include('example.widgets.icon', array('class'=>'code-fork')) fa-code-fork

                        <p>@include('example.widgets.icon', array('class'=>'unlink')) fa-unlink

                        <p>@include('example.widgets.icon', array('class'=>'chain-broei')) fa-chain-broei

                        <p>@include('example.widgets.icon', array('class'=>'question')) fa-question

                        <p>@include('example.widgets.icon', array('class'=>'info')) fa-info

                        <p>@include('example.widgets.icon', array('class'=>'exclamation')) fa-exclamation

                        <p>@include('example.widgets.icon', array('class'=>'superscript')) fa-superscript

                        <p>@include('example.widgets.icon', array('class'=>'subscript')) fa-subscript

                        <p>@include('example.widgets.icon', array('class'=>'eraser')) fa-eraser

                        <p>@include('example.widgets.icon', array('class'=>'puzzle-piece')) fa-puzzle-piece

                        <p>@include('example.widgets.icon', array('class'=>'microphone')) fa-microphone

                        <p>@include('example.widgets.icon', array('class'=>'microphone-slash'))
                            fa-microphone-slash

                        <p>@include('example.widgets.icon', array('class'=>'shield')) fa-shield

                        <p>@include('example.widgets.icon', array('class'=>'calendar-o')) fa-calendar-o

                        <p>@include('example.widgets.icon', array('class'=>'fire-extinguisher'))
                            fa-fire-extinguisher

                        <p>@include('example.widgets.icon', array('class'=>'rocket')) fa-rocket

                        <p>@include('example.widgets.icon', array('class'=>'maxcdn')) fa-maxcdn

                        <p>@include('example.widgets.icon', array('class'=>'chevron-circle-left'))
                            fa-chevron-circle-left

                        <p>@include('example.widgets.icon', array('class'=>'chevron-circle-right'))
                            fa-chevron-circle-right

                        <p>@include('example.widgets.icon', array('class'=>'chevron-circle-up'))
                            fa-chevron-circle-up

                        <p>@include('example.widgets.icon', array('class'=>'chevron-circle-down'))
                            fa-chevron-circle-down

                        <p>@include('example.widgets.icon', array('class'=>'html5')) fa-html5

                        <p>@include('example.widgets.icon', array('class'=>'css3')) fa-css3

                        <p>@include('example.widgets.icon', array('class'=>'anchor')) fa-anchor

                        <p>@include('example.widgets.icon', array('class'=>'unlock-alt')) fa-unlock-alt

                        <p>@include('example.widgets.icon', array('class'=>'bullseye')) fa-bullseye

                        <p>@include('example.widgets.icon', array('class'=>'ellipsis-h')) fa-ellipsis-h

                        <p>@include('example.widgets.icon', array('class'=>'ellipsis-v')) fa-ellipsis-v

                        <p>@include('example.widgets.icon', array('class'=>'rss-square')) fa-rss-square

                        <p>@include('example.widgets.icon', array('class'=>'play-circle')) fa-play-circle

                        <p>@include('example.widgets.icon', array('class'=>'ticket')) fa-ticket

                        <p>@include('example.widgets.icon', array('class'=>'minus-square')) fa-minus-square

                        <p>@include('example.widgets.icon', array('class'=>'minus-square-o')) fa-minus-square-o

                        <p>@include('example.widgets.icon', array('class'=>'level-up')) fa-level-up

                        <p>@include('example.widgets.icon', array('class'=>'level-down')) fa-level-down

                        <p>@include('example.widgets.icon', array('class'=>'check-square')) fa-check-square

                        <p>@include('example.widgets.icon', array('class'=>'pencil-square')) fa-pencil-square

                        <p>@include('example.widgets.icon', array('class'=>'external-link-square'))
                            fa-external-link-square

                        <p>@include('example.widgets.icon', array('class'=>'share-square')) fa-share-square

                        <p>@include('example.widgets.icon', array('class'=>'compass')) fa-compass

                        <p>@include('example.widgets.icon', array('class'=>'toggle-down')) fa-toggle-down

                        <p>@include('example.widgets.icon', array('class'=>'caret-square-o-down'))
                            fa-caret-square-o-down

                        <p>@include('example.widgets.icon', array('class'=>'toggle-up')) fa-toggle-up

                        <p>@include('example.widgets.icon', array('class'=>'caret-square-o-up'))
                            fa-caret-square-o-up

                        <p>@include('example.widgets.icon', array('class'=>'toggle-right')) fa-toggle-right

                        <p>@include('example.widgets.icon', array('class'=>'caret-square-o-right'))
                            fa-caret-square-o-right

                        <p>@include('example.widgets.icon', array('class'=>'euro')) fa-euro

                        <p>@include('example.widgets.icon', array('class'=>'eur')) fa-eur

                        <p>@include('example.widgets.icon', array('class'=>'gbp')) fa-gbp

                        <p>@include('example.widgets.icon', array('class'=>'dollar')) fa-dollar

                        <p>@include('example.widgets.icon', array('class'=>'usd')) fa-usd

                        <p>@include('example.widgets.icon', array('class'=>'rupee')) fa-rupee

                        <p>@include('example.widgets.icon', array('class'=>'inr')) fa-inr

                        <p>@include('example.widgets.icon', array('class'=>'cny')) fa-cny

                        <p>@include('example.widgets.icon', array('class'=>'rmb')) fa-rmb

                        <p>@include('example.widgets.icon', array('class'=>'yen')) fa-yen

                        <p>@include('example.widgets.icon', array('class'=>'jpy')) fa-jpy

                        <p>@include('example.widgets.icon', array('class'=>'ruble')) fa-ruble

                        <p>@include('example.widgets.icon', array('class'=>'rouble')) fa-rouble

                        <p>@include('example.widgets.icon', array('class'=>'rub')) fa-rub

                        <p>@include('example.widgets.icon', array('class'=>'won')) fa-won

                        <p>@include('example.widgets.icon', array('class'=>'krw')) fa-krw

                        <p>@include('example.widgets.icon', array('class'=>'bitcoin')) fa-bitcoin

                        <p>@include('example.widgets.icon', array('class'=>'btc')) fa-btc

                        <p>@include('example.widgets.icon', array('class'=>'file')) fa-file

                        <p>@include('example.widgets.icon', array('class'=>'file-text')) fa-file-text

                        <p>@include('example.widgets.icon', array('class'=>'sort-alpha-asc')) fa-sort-alpha-asc

                        <p>@include('example.widgets.icon', array('class'=>'sort-alpha-desc')) fa-sort-alpha-desc

                        <p>@include('example.widgets.icon', array('class'=>'sort-amount-asc')) fa-sort-amount-asc

                        <p>@include('example.widgets.icon', array('class'=>'sort-amount-desc'))
                            fa-sort-amount-desc

                        <p>@include('example.widgets.icon', array('class'=>'sort-numeric-asc'))
                            fa-sort-numeric-asc

                        <p>@include('example.widgets.icon', array('class'=>'sort-numeric-desc'))
                            fa-sort-numeric-desc

                        <p>@include('example.widgets.icon', array('class'=>'thumbs-up')) fa-thumbs-up

                        <p>@include('example.widgets.icon', array('class'=>'thumbs-down')) fa-thumbs-down

                        <p>@include('example.widgets.icon', array('class'=>'youtube-square')) fa-youtube-square

                        <p>@include('example.widgets.icon', array('class'=>'youtube')) fa-youtube

                        <p>@include('example.widgets.icon', array('class'=>'xing')) fa-xing

                        <p>@include('example.widgets.icon', array('class'=>'xing-square')) fa-xing-square

                        <p>@include('example.widgets.icon', array('class'=>'youtube-play')) fa-youtube-play

                        <p>@include('example.widgets.icon', array('class'=>'dropbox')) fa-dropbox

                        <p>@include('example.widgets.icon', array('class'=>'stack-overflow')) fa-stack-overflow

                        <p>@include('example.widgets.icon', array('class'=>'instagram')) fa-instagram

                        <p>@include('example.widgets.icon', array('class'=>'flickr')) fa-flickr

                        <p>@include('example.widgets.icon', array('class'=>'adn')) fa-adn

                        <p>@include('example.widgets.icon', array('class'=>'bitbucket')) fa-bitbucket

                        <p>@include('example.widgets.icon', array('class'=>'bitbucket-square'))
                            fa-bitbucket-square

                        <p>@include('example.widgets.icon', array('class'=>'tumblr')) fa-tumblr
                    </div>
                    <div class="fa col-lg-3">
                        <p>@include('example.widgets.icon', array('class'=>'tumblr-square')) fa-tumblr-square

                        <p>@include('example.widgets.icon', array('class'=>'long-arrow-down')) fa-long-arrow-down

                        <p>@include('example.widgets.icon', array('class'=>'long-arrow-up')) fa-long-arrow-up

                        <p>@include('example.widgets.icon', array('class'=>'long-arrow-left')) fa-long-arrow-left

                        <p>@include('example.widgets.icon', array('class'=>'long-arrow-right'))
                            fa-long-arrow-right

                        <p>@include('example.widgets.icon', array('class'=>'apple')) fa-apple

                        <p>@include('example.widgets.icon', array('class'=>'windows')) fa-windows

                        <p>@include('example.widgets.icon', array('class'=>'android')) fa-android

                        <p>@include('example.widgets.icon', array('class'=>'linux')) fa-linux

                        <p>@include('example.widgets.icon', array('class'=>'dribbble')) fa-dribbble

                        <p>@include('example.widgets.icon', array('class'=>'skype')) fa-skype

                        <p>@include('example.widgets.icon', array('class'=>'foursquare')) fa-foursquare

                        <p>@include('example.widgets.icon', array('class'=>'trello')) fa-trello

                        <p>@include('example.widgets.icon', array('class'=>'female')) fa-female

                        <p>@include('example.widgets.icon', array('class'=>'male')) fa-male

                        <p>@include('example.widgets.icon', array('class'=>'gittip')) fa-gittip

                        <p>@include('example.widgets.icon', array('class'=>'sun-o')) fa-sun-o

                        <p>@include('example.widgets.icon', array('class'=>'moon-o')) fa-moon-o

                        <p>@include('example.widgets.icon', array('class'=>'archive')) fa-archive

                        <p>@include('example.widgets.icon', array('class'=>'bug')) fa-bug

                        <p>@include('example.widgets.icon', array('class'=>'vk')) fa-vk

                        <p>@include('example.widgets.icon', array('class'=>'weibo')) fa-weibo

                        <p>@include('example.widgets.icon', array('class'=>'renren')) fa-renren

                        <p>@include('example.widgets.icon', array('class'=>'pagelines')) fa-pagelines

                        <p>@include('example.widgets.icon', array('class'=>'stack-exchange')) fa-stack-exchange

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-o-right'))
                            fa-arrow-circle-o-right

                        <p>@include('example.widgets.icon', array('class'=>'arrow-circle-o-left'))
                            fa-arrow-circle-o-left

                        <p>@include('example.widgets.icon', array('class'=>'toggle-left')) fa-toggle-left

                        <p>@include('example.widgets.icon', array('class'=>'caret-square-o-left'))
                            fa-caret-square-o-left

                        <p>@include('example.widgets.icon', array('class'=>'dot-circle-o')) fa-dot-circle-o

                        <p>@include('example.widgets.icon', array('class'=>'wheelchair')) fa-wheelchair

                        <p>@include('example.widgets.icon', array('class'=>'vimeo-square')) fa-vimeo-square

                        <p>@include('example.widgets.icon', array('class'=>'turkish-lira')) fa-turkish-lira

                        <p>@include('example.widgets.icon', array('class'=>'try')) fa-try

                        <p>@include('example.widgets.icon', array('class'=>'plus-square-o')) fa-plus-square-o

                        <p>@include('example.widgets.icon', array('class'=>'space-shuttle')) fa-space-shuttle

                        <p>@include('example.widgets.icon', array('class'=>'slack')) fa-slack

                        <p>@include('example.widgets.icon', array('class'=>'envelope-square')) fa-envelope-square

                        <p>@include('example.widgets.icon', array('class'=>'wordpress')) fa-wordpress

                        <p>@include('example.widgets.icon', array('class'=>'openid')) fa-openid

                        <p>@include('example.widgets.icon', array('class'=>'institution')) fa-institution

                        <p>@include('example.widgets.icon', array('class'=>'bank')) fa-bank

                        <p>@include('example.widgets.icon', array('class'=>'university')) fa-university

                        <p>@include('example.widgets.icon', array('class'=>'mortar-board')) fa-mortar-board

                        <p>@include('example.widgets.icon', array('class'=>'graduation-cap')) fa-graduation-cap

                        <p>@include('example.widgets.icon', array('class'=>'yahoo')) fa-yahoo

                        <p>@include('example.widgets.icon', array('class'=>'google')) fa-google

                        <p>@include('example.widgets.icon', array('class'=>'reddit')) fa-reddit

                        <p>@include('example.widgets.icon', array('class'=>'reddit-square')) fa-reddit-square

                        <p>@include('example.widgets.icon', array('class'=>'stumbleupon-circle'))
                            fa-stumbleupon-circle

                        <p>@include('example.widgets.icon', array('class'=>'stumbleupon')) fa-stumbleupon

                        <p>@include('example.widgets.icon', array('class'=>'delicious')) fa-delicious

                        <p>@include('example.widgets.icon', array('class'=>'digg')) fa-digg

                        <p>@include('example.widgets.icon', array('class'=>'pied-piper-square'))
                            fa-pied-piper-square

                        <p>@include('example.widgets.icon', array('class'=>'pied-piper')) fa-pied-piper

                        <p>@include('example.widgets.icon', array('class'=>'pied-piper-alt')) fa-pied-piper-alt

                        <p>@include('example.widgets.icon', array('class'=>'drupal')) fa-drupal

                        <p>@include('example.widgets.icon', array('class'=>'joomla')) fa-joomla

                        <p>@include('example.widgets.icon', array('class'=>'language')) fa-language

                        <p>@include('example.widgets.icon', array('class'=>'fax')) fa-fax

                        <p>@include('example.widgets.icon', array('class'=>'building')) fa-building

                        <p>@include('example.widgets.icon', array('class'=>'child')) fa-child

                        <p>@include('example.widgets.icon', array('class'=>'paw')) fa-paw

                        <p>@include('example.widgets.icon', array('class'=>'spoon')) fa-spoon

                        <p>@include('example.widgets.icon', array('class'=>'cube')) fa-cube

                        <p>@include('example.widgets.icon', array('class'=>'cubes')) fa-cubes

                        <p>@include('example.widgets.icon', array('class'=>'behance')) fa-behance

                        <p>@include('example.widgets.icon', array('class'=>'behance-square')) fa-behance-square

                        <p>@include('example.widgets.icon', array('class'=>'steam')) fa-steam

                        <p>@include('example.widgets.icon', array('class'=>'steam-square')) fa-steam-square

                        <p>@include('example.widgets.icon', array('class'=>'recycle')) fa-recycle

                        <p>@include('example.widgets.icon', array('class'=>'automobile')) fa-automobile

                        <p>@include('example.widgets.icon', array('class'=>'car')) fa-car

                        <p>@include('example.widgets.icon', array('class'=>'cab')) fa-cab

                        <p>@include('example.widgets.icon', array('class'=>'taxi')) fa-taxi

                        <p>@include('example.widgets.icon', array('class'=>'tree')) fa-tree

                        <p>@include('example.widgets.icon', array('class'=>'spotify')) fa-spotify

                        <p>@include('example.widgets.icon', array('class'=>'deviantart')) fa-deviantart

                        <p>@include('example.widgets.icon', array('class'=>'soundcloud')) fa-soundcloud

                        <p>@include('example.widgets.icon', array('class'=>'database')) fa-database

                        <p>@include('example.widgets.icon', array('class'=>'file-pdf-o')) fa-file-pdf-o

                        <p>@include('example.widgets.icon', array('class'=>'file-word-o')) fa-file-word-o

                        <p>@include('example.widgets.icon', array('class'=>'file-excel-o')) fa-file-excel-o

                        <p>@include('example.widgets.icon', array('class'=>'file-powerpoint-o'))
                            fa-file-powerpoint-o

                        <p>@include('example.widgets.icon', array('class'=>'file-photo-o')) fa-file-photo-o

                        <p>@include('example.widgets.icon', array('class'=>'file-picture-o')) fa-file-picture-o

                        <p>@include('example.widgets.icon', array('class'=>'file-image-o')) fa-file-image-o

                        <p>@include('example.widgets.icon', array('class'=>'file-zip-o')) fa-file-zip-o

                        <p>@include('example.widgets.icon', array('class'=>'file-archive-o')) fa-file-archive-o

                        <p>@include('example.widgets.icon', array('class'=>'file-sound-o')) fa-file-sound-o

                        <p>@include('example.widgets.icon', array('class'=>'file-audio-o')) fa-file-audio-o

                        <p>@include('example.widgets.icon', array('class'=>'file-movie-o')) fa-file-movie-o

                        <p>@include('example.widgets.icon', array('class'=>'file-video-o')) fa-file-video-o

                        <p>@include('example.widgets.icon', array('class'=>'file-code-o')) fa-file-code-o

                        <p>@include('example.widgets.icon', array('class'=>'vine')) fa-vine

                        <p>@include('example.widgets.icon', array('class'=>'codepen')) fa-codepen

                        <p>@include('example.widgets.icon', array('class'=>'jsfiddle')) fa-jsfiddle

                        <p>@include('example.widgets.icon', array('class'=>'life-bouy')) fa-life-bouy

                        <p>@include('example.widgets.icon', array('class'=>'life-saver')) fa-life-saver

                        <p>@include('example.widgets.icon', array('class'=>'support')) fa-support

                        <p>@include('example.widgets.icon', array('class'=>'life-ring')) fa-life-ring

                        <p>@include('example.widgets.icon', array('class'=>'circle-o-notch')) fa-circle-o-notch

                        <p>@include('example.widgets.icon', array('class'=>'ra')) fa-ra

                        <p>@include('example.widgets.icon', array('class'=>'rebel')) fa-rebel

                        <p>@include('example.widgets.icon', array('class'=>'ge')) fa-ge

                        <p>@include('example.widgets.icon', array('class'=>'empire')) fa-empire

                        <p>@include('example.widgets.icon', array('class'=>'git-square')) fa-git-square

                        <p>@include('example.widgets.icon', array('class'=>'git')) fa-git

                        <p>@include('example.widgets.icon', array('class'=>'hacker-news')) fa-hacker-news

                        <p>@include('example.widgets.icon', array('class'=>'tencent-weibo')) fa-tencent-weibo

                        <p>@include('example.widgets.icon', array('class'=>'qq')) fa-qq

                        <p>@include('example.widgets.icon', array('class'=>'wechat')) fa-wechat

                        <p>@include('example.widgets.icon', array('class'=>'weixin')) fa-weixin

                        <p>@include('example.widgets.icon', array('class'=>'send')) fa-send

                        <p>@include('example.widgets.icon', array('class'=>'paper-plane')) fa-paper-plane

                        <p>@include('example.widgets.icon', array('class'=>'send-o')) fa-send-o

                        <p>@include('example.widgets.icon', array('class'=>'paper-plane-o')) fa-paper-plane-o

                        <p>@include('example.widgets.icon', array('class'=>'history')) fa-history

                        <p>@include('example.widgets.icon', array('class'=>'circle-thin')) fa-circle-thin

                        <p>@include('example.widgets.icon', array('class'=>'header')) fa-header

                        <p>@include('example.widgets.icon', array('class'=>'paragraph')) fa-paragraph

                        <p>@include('example.widgets.icon', array('class'=>'sliders')) fa-sliders

                        <p>@include('example.widgets.icon', array('class'=>'share-alt')) fa-share-alt

                        <p>@include('example.widgets.icon', array('class'=>'share-alt-square'))
                            fa-share-alt-square

                        <p>@include('example.widgets.icon', array('class'=>'bomb')) fa-bomb

                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
    <!-- /.col-lg-12 -->

@endsection