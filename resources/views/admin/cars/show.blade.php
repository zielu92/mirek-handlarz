@extends('admin.layout.admin')

@section('styles')
    <style>
        /* _wrapper.css */
        .wrapper {
        padding-left: 18px;
        padding-right: 18px;
        max-width: 1236px;
        margin-left: auto;
        margin-right: auto;
        }

        /* _page-section.css */
        .page-section {
        padding: 50px 0;

        }
        @media (min-width: 800px){
        .page-section{
        padding: 50px 0;
        }
        }
        .page-section--gray {
        background-color: #f0f0f0;
        }

        /* _section-title.css */
        .section-title {
        text-align: center;
        font-size: 32px;
        font-weight: 300;
        margin: 0 0 60px 0;
        }
        @media (min-width: 800px){
        .section-title{
        font-size: 55px;
        }
        }
        .section-title--gray {
        color: #9D9DA6;
        }


        /* _timeline.css */
        .timeline {
        position: relative;
        padding: 100px 0;

        }
        .timeline::before {
        content: "";
        position: absolute;
        top: 0;
        left: 10%;
        width: 4px;
        height: 100%;
        background-color: #DFDFDF;
        }
        @media (min-width: 800px){
        .timeline::before{
        left: 50%;
        margin-left: -2px;
        }
        }
        .timeline__item {
        margin-bottom: 100px;
        position: relative;
        }
        .timeline__item::after{
        content: "";
        clear: both;
        display: table;
        }
        .timeline__item:nth-child(2n) .timeline__item__content {
        float: right;
        }
        @media (min-width: 800px){
        .timeline__item:nth-child(2n) .timeline__item__content::before{
        left: -20px;
        border-right: 20px solid #fff;
        border-left: 0;
        }
        }
        .timeline__item:last-child {
        margin-bottom: 0;
        }
        .timeline__item__date {
        background-color: #DFDFDF;
        font-weight: 300;
        width: 140px;
        position: absolute;
        padding: 10px;
        top: -18px;
        left: 10%;
        margin-left: -33px;
        transition: all .3s ease-out;
        text-align: center;
        color: #adadad;
        border-radius: 6px;
        font-size: 14px;
        z-index: 1;
        }
        @media (min-width: 800px){
        .timeline__item__date{
        top: 30px;
        left: 50%;
        margin-left: -70px;
        }
        }
        .timeline__item__date strong {
        font-weight: 700;
        }
        .timeline__item__content {
        width: 80%;
        background: #fff;
        border-radius: 6px;
        float: right;
        transition: all .3s ease-out;
        padding: 30px 30px 25px 30px;
        position: relative;
        }
        @media (min-width: 800px){
        .timeline__item__content{
        width: 36%;
        float: inherit;
        }
        }
        @media (min-width: 1200px){
        .timeline__item__content{
        width: 40%;
        float: inherit;
        }
        }
        @media (min-width: 800px){
        .timeline__item__content::before{
        content: "";
        position: absolute;
        top: 30px;
        right: -20px;
        width: 0;
        height: 0;
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
        border-left: 20px solid #fff;
        }
        }
        .timeline__item__content__logo {
        text-align: center;
        margin-bottom: 25px;
        }
        .timeline__item__content__title {
        margin: 0;
        padding: 0;
        margin-bottom: 5px;
        font-size: 20px;
        color: #464545;
        }
        @media (min-width: 800px){
        .timeline__item__content__title{
        font-size: 24px;
        }
        }
        .timeline__item__content__description {
        margin: 0;
        padding: 0;
        font-size: 16px;
        line-height: 24px;
        font-weight: 300;
        color: #A7A7A6;
        }
        @media (min-width: 800px){
        .timeline__item__content__description{
        font-size: 19px;
        line-height: 28px;
        }
        }
        .timeline__item__content__techs {
        margin-top: 15px;
        text-align: right;
        }
        .timeline__info__content {
            background: #fff;
            border-radius: 6px;
            transition: all .3s ease-out;
            padding: 30px 30px 25px 30px;

        }
        .fa-lg {
            font-size:4.6em !important;
        }
    </style>
@endsection

@section('content')


<div class="page-section page-section--gray">
    <div class="wrapper">
        <h2 class="section-title section-title--gray">
           #{{$car->id}}  <b>{{$car->model->brand->name}}</b> {{$car->model->model}}
        </h2>
        <div class="timeline">
            @if($car->bought_date)
            <div class="timeline__item">
                <div class="timeline__item__date">{{$car->bought_date}}</div>
                <div class="timeline__item__content">
                    <div class="timeline__item__content__logo">
                        <i class="fa fa-lg fa-shopping-cart"></i>
                    </div>
                    <h3 class="timeline__item__content__title">
                        Zakupiono
                    </h3>
                    <p class="timeline__item__content__description">
                        <b>{{$car->model->brand->name}}</b> {{$car->model->model}}<br>
                        Od {{$car->from}} za cenę <b>{{$car->bought_price}}</b><br>
                        VIN pojazdu: {{$car->vin}}
                    </p>
                </div>
            </div>
            @endif
            @if($car->in_warehouse_date)
            <div class="timeline__item">
                <div class="timeline__item__date">{{$car->in_warehouse_date}}</div>
                <div class="timeline__item__content">
                    <div class="timeline__item__content__logo">
                        <i class="fa fa-lg fa-h-square"></i>
                    </div>
                    <h3 class="timeline__item__content__title">
                        Przybycie do magazynu
                    </h3>
                    <p class="timeline__item__content__description">
                        @if($transportIn)
                            Pojazd przywózł <b>{{$transportIn[0]->driver->name}}</b><br>
                            Pojazdem o numerach rejestracyjnych <b>{{$transportIn[0]->plates}}</b>
                            <a href="{{route('admin.transport.show',$transportIn[0]->id)}}">
                                Informację o transporcie</a>
                        @else
                            Brak informacji o transporcie
                        @endif
                    </p>
                </div>
            </div>
            @endif
            @if($car->sold_date)
            <div class="timeline__item">
                <div class="timeline__item__date"><strong>{{$car->sold_date}}</strong></div>
                <div class="timeline__item__content">
                    <div class="timeline__item__content__logo">
                        <i class="fa fa-lg fa-dollar"></i>
                    </div>
                    <h3 class="timeline__item__content__title">
                        Sprzedaż
                    </h3>
                    <p class="timeline__item__content__description">
                        Pojazd zakupił <b>{{$car->customer->name}}</b>, za cenę <b>{{$car->sold_price}}</b>
                    </p>
                    <div class="timeline__item__content__techs">
                        <span class="icon icon--sketch"></span>
                    </div>
                </div>
            </div>
            @endif
            @if($car->left_warehouse_date)
            <div class="timeline__item">
                <div class="timeline__item__date">{{$car->left_warehouse_date}}</div>
                <div class="timeline__item__content">
                    <div class="timeline__item__content__logo">
                        <i class="fa fa-lg fa-arrow-right"></i>
                    </div>
                    <h3 class="timeline__item__content__title">
                        Pojazd opuścił magazyn
                    </h3>
                    <p class="timeline__item__content__description">
                        @if($transportOut)
                            Pojazd przywózł <b>{{$transportOut[0]->driver->name}}</b><br>
                            Pojazdem o numerach rejestracyjnych <b>{{$transportOut[0]->plates}}</b>
                            <a href="{{route('admin.transport.show',$transportOut[0]->id)}}">
                                Informację o transporcie</a>
                        @else
                            Brak informacji o transporcie
                        @endif
                    </p>
                </div>
            </div>
            @endif
        </div>
        @include('includes.carPictures')
    </div>
</div>

@endsection