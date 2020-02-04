@extends('layouts.app')
@section('content')
    <div class="section">
        <div style="margin-top: -120px">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <md-card class="my-card">
                            <md-card-header>
                                <div class="d-flex justify-content-center">
                                    <img style="max-width: 50px; opacity: 0.6" class="m-auto" src="{{url('/storage/default/plane.svg')}}">
                                </div>
                            </md-card-header>
                            <md-card-content>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <h3 class="text-center text-grey font-weight-bold mt-3" style="font-size: 1.3rem">Email</h3>
                                    <a href="mailto: {{setting('site.email')}}" class="my-4 w-100 text-center text-grey" style="text-decoration: none !important;">{{setting('site.email')}}</a>
                                </div>
                            </md-card-content>
                        </md-card>
                    </div>
                    <div class="col-md-4">
                        <md-card class="my-card">
                            <md-card-header>
                                <div class="d-flex justify-content-center">
                                    <img style="max-width: 50px; opacity: 0.6" class="m-auto" src="{{url('/storage/default/telephone.svg')}}">
                                </div>
                            </md-card-header>
                            <md-card-content>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <h3 class="text-center text-grey font-weight-bold mt-3" style="font-size: 1.3rem">Telefon</h3>
                                    <p class="my-4 w-100 text-center text-primary" style="text-decoration: none !important;">{{setting('site.phone')}}</p>
                                </div>
                            </md-card-content>
                        </md-card>
                    </div>
                    <div class="col-md-4">
                        <md-card class="my-card">
                            <md-card-header>
                                <div class="d-flex justify-content-center">
                                    <img style="max-width: 50px; opacity: 0.6" class="m-auto" src="{{url('/storage/default/speech-bubble.svg')}}">
                                </div>
                            </md-card-header>
                            <md-card-content>
                                <div class="d-flex justify-content-center flex-wrap">
                                    <h3 class="text-center text-grey font-weight-bold mt-3" style="font-size: 1.3rem">Czat</h3>
                                    <a href="mailto: {{setting('site.email')}}" class="my-4 w-100 text-center text-grey" style="text-decoration: none !important;">{{setting('site.chat')}}</a>
                                </div>
                            </md-card-content>
                        </md-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <transition name="fade">
            <form novalidate @submit.prevent="sendMessage" v-if="!contact.sended">
                <div class="mt-5">
                    <h2 class="header text-grey">Skontaktuj się z nami</h2>
                    <md-field :class="getValidationClass('email')">
                        <label>Wpisz swój adres email</label>
                        <md-input v-model="contact.email"></md-input>
                        <span class="md-error" v-if="!$v.contact.email.required">Te pole jest wymagane</span>
                        <span class="md-error" v-if="!$v.contact.email.email">Te pole powinno być poprawnym adresem email</span>
                    </md-field>
                    <md-field :class="getValidationClass('topic')">
                        <label>Wybierz kategorię</label>
                        <md-select v-model="contact.topic">
                            <md-option value="Sprzedaż">Sprzedaż</md-option>
                            <md-option value="Oklejenie">Oklejanie</md-option>
                            <md-option value="Oferta">Oferta</md-option>
                        </md-select>
                        <span class="md-error" v-if="!$v.contact.topic.required">Te pole jest wymagane</span>

                    </md-field>
                    <md-field :class="getValidationClass('content')">
                        <label>Wpisz treść wiadomości</label>
                        <md-textarea v-model="contact.content"></md-textarea>
                        <span class="md-error" v-if="!$v.contact.content.required">Te pole jest wymagane</span>
                    </md-field>
                    <md-button :disabled="contact.sending || contact.sended" type="submit" class="md-raised md-primary ml-0 mr-0">Wyślij</md-button>
                </div>
            </form>
        </transition>
        <transition name="fade">
            <md-empty-state
                    class="mt-5"
                    v-if="contact.sended"
                    md-rounded
                    md-icon="done"
                    md-label="Wiadomość została wysłana"
                    md-description="Dziękujemy za wysłanie wiadomości kontaktowej. Skontaktujemy się z Tobą w najbliższym czasie.">
            </md-empty-state>
        </transition>
    </div>

    <div class="give-me-space">
        <div class="container">
            <h2 class="header text-grey">Pytania i odpowiedźi</h2>
            @foreach($faqs as $key => $group)
                <h4 class="font-weight-bold my-3 text-grey">{{$key}}</h4>
                @foreach($group as $faq)
                <div class="faq" @click="(expand_faq && expand_faq.id == '{{$faq->id}}')? expand_faq = null : expand_faq = {{$faq}}">
                    <div class="d-flex flex-wrap justify-content-between">
                        <div><span class="head">{{$faq->question}}</span></div>
                        <div>
                            <md-icon>expand_more</md-icon>
                        </div>
                    </div>
                    <transition name="slideTop">
                        <div class="content mt-5 mb-5" v-show="expand_faq && expand_faq.id == '{{$faq->id}}'">
                            {{$faq->answer}}
                        </div>
                    </transition>
                </div>
                    @endforeach
                @endforeach
        </div>
    </div>
    @endsection
