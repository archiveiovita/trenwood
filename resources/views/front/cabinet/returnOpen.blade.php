@extends('front.app')
@section('content')
@include('front.layouts.header')
<div class="collectionOne registration">
  <div class="container">
    <div class="cabCat bagDate">
      <div class="sal">
        {{trans('front.cabinet.hello', ['name' => $userdata->name, 'surname' => $userdata->surname])}}
      </div>
      <ul>
        <li><a href="{{route('cabinet')}}">{{trans('front.cabinet.userdata')}}</a></li>
        <li><a href="{{route('cart')}}">{{trans('front.cabinet.cart')}}</a></li>
        <li><a href="{{route('cabinet.wishList')}}">{{trans('front.cabinet.wishList')}}</a></li>
        <li><a href="{{route('cabinet.history')}}">{{trans('front.cabinet.history')}}</a></li>
        <li class="pageActiveCab"><a href="{{route('cabinet.return')}}">{{trans('front.cabinet.return')}}</a></li>
        <li><a href="{{url($lang->lang.'/logout')}}">{{trans('front.cabinet.logout')}}</a></li>
      </ul>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-12 borderBottom">
          <h3>{{trans('front.cabinet.return')}}</h3>
        </div>
        <div class="col-lg-3 col-md-12">
          <div class="cabCat">
            <div class="sal">
              {{trans('front.cabinet.hello', ['name' => $userdata->name, 'surname' => $userdata->surname])}}
            </div>
            <ul>
              <li><a href="{{route('cabinet')}}">{{trans('front.cabinet.userdata')}}</a></li>
              <li><a href="{{route('cart')}}">{{trans('front.cabinet.cart')}}</a></li>
              <li><a href="{{route('cabinet.wishList')}}">{{trans('front.cabinet.wishList')}}</a></li>
              <li><a href="{{route('cabinet.history')}}">{{trans('front.cabinet.history')}}</a></li>
              <li class="pageActiveCab"><a href="{{route('cabinet.return')}}">{{trans('front.cabinet.return')}}</a></li>
              <li><a href="{{url($lang->lang.'/logout')}}">{{trans('front.cabinet.logout')}}</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 col-md-12 cabFormNew historyOneOpen">
          <div class="row borders">
            <div class="col-12">
              <h5>{{trans('front.cabinet.historyAll.idDetails', ['id' => $order->id])}}</h5>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="invalid-feedback text-center" style="display: block">
                      {!!$error!!}
                    </div>
                @endforeach
            @endif

            @if (Session::has('success'))
                <div class="valid-feedback text-center" style="display: block">
                    {{ Session::get('success') }}
                </div>
            @endif
          </div>

          <div class="row borders">
            <div class="col-12 textGrey">
              {{trans('front.cabinet.historyAll.secondStatus', ['id' => $order->id, 'status' => $order->secondarystatus])}}
            </div>
          </div>
          <div class="row borders">
            <div class="col-sm-4 col-12">
              <div class="textGreyUp">
                {{trans('front.cabinet.historyAll.deliveryDetails')}}
              </div>
              <ul>
                <li>{{$userdata->name}} {{$userdata->surname}}</li>
                <li>{{$userdata->phone.','}} {{$userdata->email}}</li>
              </ul>
            </div>
            <div class="col-sm-4 col-12">
              <div class="textGreyUp">
                {{trans('front.cabinet.historyAll.deliveryFactory')}}
              </div>
              <ul>
                @if (count($order->addressById()->first()) > 0)
                    <?php $address = $order->addressById()->first(); ?>
                    <li>  {{$address->getCountryById()->first() ? $address->getCountryById()->first()->name.',' : ''}}
                          {{$address->getRegionById()->first() ? $address->getRegionById()->first()->name.',' : ''}}
                          {{$address->getCityById()->first() ? $address->getCityById()->first()->name.',' : ''}}
                          {{$address->address}}</li>
                @else
                    <?php $address = $order->addressPickupById()->first(); ?>
                    @if (!is_null($address))
                        <li>{{$address->value}}</li>
                    @endif
                @endif
              </ul>
            </div>
            <div class="col-sm-4 col-12">
              <div class="textGreyUp">
                {{trans('front.cabinet.historyAll.payment')}}
              </div>
              <ul>
                <li>{{trans('front.cabinet.historyOrder.'.$order->payment)}}</li>
                <li>{{trans('front.cabinet.historyAll.paymentTotal', ['amount' => $order->amount])}}</li>
              </ul>
            </div>
          </div>
          <div class="row borders">
            <div class="col-12">
              <h5>{{trans('front.cabinet.historyAll.status')}}</h5>
            </div>
          </div>
          <div class="row borders">
            <div class="col-12">
                <div class="row padLit">
                  <div class="col-12 emptyBox">
                    <div class="fillBox{{ucfirst($order->status)}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-8 comands">
                <div class="{{$order->status == 'pending' ? 'comandaPlasataActive' : 'comandaPlasata'}}">
                  25% <br><strong>{{trans('front.cabinet.status.pending')}}</strong>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-8 comands">
                <div class="{{$order->status == 'processing' ? 'comandaInProcesareActive' : 'comandaInProcesare'}}">
                  50% <br><strong>{{trans('front.cabinet.status.processing')}}</strong>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-8 comands">
                <div class="{{$order->status == 'inway' ? 'comandaInLivrareActive' : 'comandaInLivrare'}}">
                  75% <br><strong>{{trans('front.cabinet.status.inway')}}</strong>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-8 comands">
                <div class="{{$order->status == 'completed' ? 'comandaLivrataActive' : 'comandaLivrata'}}">
                  100% <br><strong>{{trans('front.cabinet.status.completed')}}</strong>
                </div>
              </div>
          </div>
          <div class="row borders">
            <div class="col-12">
              <h5>{{trans('front.cabinet.historyAll.products')}}</h5>
            </div>
          </div>

          @if (count($order->orderSets) > 0)
              @foreach ($order->orderSets as $orderSet)
                <div class="row borders">
                  <div class="col-12">
                    <div class="row oneSetHistory">
                      <div class="historyImgItem col-sm-2 col-3">
                        @if ($orderSet->set()->first())
                        <img src="/images/sets/og/{{ $orderSet->set()->first()->withoutBack()->first()->src }}" alt="">
                        @else
                        <img src="{{ asset('/images/no-image.png') }}" alt="">
                        @endif
                      </div>
                      <div class="col-lg-6 col-md-5 col-sm-4 col-9 band">
                        <div class="namSetRetur">
                          {{ $orderSet->set->translationByLanguage($lang->id)->first()->name }} {!!trans('front.cabinet.historyAll.oneSet')!!}
                        </div>
                        <div>
                          {{trans('front.cabinet.historyAll.cod')}} <span class="stoc">{{ $orderSet->set->id}}</span>
                        </div>
                      </div>
                      <div class="offset-lg-0 offset-md-1 col-sm-2 col-6 text-right margMobile">
                        <div>
                          {{ $orderSet->set->price }} {{trans('front.general.currency')}}
                        </div>
                        <div class="textGrey">
                          {{ $orderSet->qty }} {{trans('front.cabinet.unit')}}
                        </div>
                      </div>
                      <div class="col-sm-2 col-3 margMobile text-right">
                        <form action="{{route('cabinet.addSetsToReturn', $orderSet->id)}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="return_id" value="{{count($return) > 0 ? $return->id : '0'}}">
                          <input type="hidden" name="returnOrder" value="0">
                          <div>
                            <label class="containerCheck">{{trans('front.cabinet.returnAll.return')}}
                              @if (count($return) > 0)
                                  <input {{count($return->returnSets) > 0 && $return->returnSets->contains('return_id', $return->id) ? 'checked' : ''}} type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                              @else
                                  <input type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                              @endif
                              <span class="checkmarkCheck"></span>
                            </label>
                          </div>
                        </form>
                      </div>
                      <div class="returSetOpen col-11">
                        @if (count($orderSet->orderProduct) > 0)
                          @foreach ($orderSet->orderProduct as $orderProduct)
                            <div class="row returItemSet">
                              <div class="historyImgItem col-sm-2 col-3">
                                @if ($orderProduct->product->withoutBack()->first())
                                    <img id="prOneBig1" src="{{ asset('images/products/og/'.$orderProduct->product->withoutBack()->first()->src ) }}">
                                @else
                                    <img src="{{ asset('fronts/img/products/noimage.png') }}" alt="img-advice">
                                @endif
                              </div>
                              <div class="col-sm-4 col-9">
                                <div>
                                  {{$orderProduct->product->translationByLanguage($lang->id)->first()->name}} {!!trans('front.cabinet.historyAll.oneProduct')!!}
                                </div>
                                <div>
                                  {{trans('front.cabinet.historyAll.cod')}} <span class="stoc">{{$orderProduct->subproduct->code}}</span>
                                </div>
                              </div>
                              <div class="offset-md-2 col-sm-2 col-7 text-right margMobile">
                                <div>
                                  {{$orderProduct->subproduct->price - ($orderProduct->subproduct->price * $orderProduct->subproduct->discount / 100)}} {{trans('front.general.currency')}}
                                </div>
                                <div class="textGrey">
                                  {{$orderProduct->qty}} {{trans('front.cabinet.unit')}}
                                </div>
                              </div>
                              <div class="col-auto margMobile text-right">
                                <form action="{{route('cabinet.addProductsToReturn', $orderProduct->id)}}" method="post">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="return_id" value="{{count($return) > 0 ? $return->id : '0'}}">
                                  <input type="hidden" name="returnOrder" value="0">
                                  <div>
                                    <label class="containerCheck">{{trans('front.cabinet.returnAll.return')}}
                                      @if (count($return) > 0)
                                          <input {{count($return->returnProducts()->get()) > 0 && $return->returnProducts()->get()->contains('orderProduct_id', $orderProduct->id) ? 'checked' : ''}} type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                                      @else
                                          <input type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                                      @endif
                                      <span class="checkmarkCheck"></span>
                                    </label>
                                  </div>
                                </form>
                              </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          @endif

          @if (count($order->orderProductsNoSet) > 0)
              @foreach ($order->orderProductsNoSet as $orderProduct)
                <div class="row borders">
                  <div class="col-12">
                    <div class="row oneItemHistory">
                      <div class="historyImgItem col-sm-2 col-3">
                        @if ($orderProduct->product->withoutBack()->first())
                            <img id="prOneBig1" src="{{ asset('images/products/og/'.$orderProduct->product->withoutBack()->first()->src ) }}">
                        @else
                            <img src="{{ asset('fronts/img/products/noimage.png') }}" alt="img-advice">
                        @endif
                      </div>
                      <div class="col-sm-4 col-8">
                        <div class="oneProductName">
                          {{$orderProduct->product->translationByLanguage($lang->id)->first()->name}} {!!trans('front.cabinet.historyAll.oneProduct')!!}
                        </div>
                        <div>
                          {{trans('front.cabinet.historyAll.cod')}} <span class="stoc">{{$orderProduct->subproduct->code}}</span>
                        </div>
                      </div>
                      <div class="offset-md-2 col-sm-2 col-6 text-right margMobile">
                        <div>
                          {{$orderProduct->subproduct->price - ($orderProduct->subproduct->price * $orderProduct->subproduct->discount / 100)}} {{trans('front.general.currency')}}
                        </div>
                        <div class="textGrey">
                          {{$orderProduct->qty}} {{trans('front.cabinet.unit')}}
                        </div>
                      </div>
                      <div class="col-auto margMobile text-right">
                        <form action="{{route('cabinet.addProductsToReturn', $orderProduct->id)}}" method="post">
                          {{ csrf_field() }}
                          <input type="hidden" name="return_id" value="{{count($return) > 0 ? $return->id : '0'}}">
                          <input type="hidden" name="returnOrder" value="0">
                          <div>
                            <label class="containerCheck">{{trans('front.cabinet.returnAll.return')}}
                              @if (count($return) > 0)
                                  <input {{count($return->returnProducts()->get()) > 0 && $return->returnProducts()->get()->contains('orderProduct_id', $orderProduct->id) ? 'checked' : ''}} type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                              @else
                                  <input type="checkbox" onclick="addReturn(this)" name="returnOrder" value="1">
                              @endif
                              <span class="checkmarkCheck" ></span>
                            </label>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          @endif

          <div class="row totalHistoryOpen">
            <div class="col-12">
              {{trans('front.cabinet.historyAll.deliveryMethod', ['delivery' => $order->delivery])}}
            </div>
            <div class="col-12">
              {{trans('front.cabinet.historyAll.paymentMethod', ['payment' => $order->payment])}}
            </div>
            <div class="col-12">
              {!!trans('front.cabinet.historyAll.totalSum', ['amount' => $order->amount])!!}
            </div>
          </div>
          <div class="row formRetur">
            <div class="col-12">
              <h4>{{trans('front.cabinet.returnAll.requiredData')}}</h4>
              <form action="{{route('cabinet.saveReturn', count($return) > 0 ? $return->id : '0')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-12">
                    <textarea rows="4" name="motive" placeholder="{{trans('front.cabinet.returnAll.motive')}}">{{count($return) > 0 ? $return->motive: ''}}</textarea>
                  </div>
                  <div class="col-12 margeTop2">
                    <h4>{{trans('front.cabinet.returnAll.method')}}</h4></div>
                  <div class="col-sm-6 col-12 selRetur">
                    <select name="payment">
                      <option {{!empty($return) && $return->payment == 'card' ? 'selected' : ''}} value="card">{{trans('front.cabinet.returnAll.card')}}</option>
                      <option {{!empty($return) && $return->payment == 'paypal' ? 'selected' : ''}} value="paypal">{{trans('front.cabinet.returnAll.paypal')}}</option>
                      <option {{!empty($return) && $return->payment == 'invoice' ? 'selected' : ''}} value="invoice">{{trans('front.cabinet.returnAll.invoice')}}</option>
                      <option {{!empty($return) && $return->payment == 'cash' ? 'selected' : ''}} value="cash">{{trans('front.cabinet.returnAll.cash')}}</option>
                      <option {{!empty($return) && $return->payment == 'goods' ? 'selected' : ''}} value="goods">{{trans('front.cabinet.returnAll.goods')}}</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <div class="row justify-content-end">
                      <div class="col-lg-4 col-md-5 col-sm-6 col-7">
                          <input class="btnSubmit" type="submit" value="{{trans('front.cabinet.returnAll.returnBtn')}}">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('front.layouts.footer')
@stop
