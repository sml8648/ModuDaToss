@extends('layouts.app')

@section('content')

@if( isset(Auth::user()->name) )
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <nav class="navbar navbar-default">
                  <div class="container-fluid">
                      <ul class="nav navbar-nav">
                          <li><a href="/Partner/{{Auth::user()->category}}/전체">전체</a></li>
                          <li><a href="/Partner/{{Auth::user()->category}}/접수 완료">접수</a></li>
                          <li><a href="/Partner/{{Auth::user()->category}}/진행중">진행중</a></li>
                          <li><a href="/Partner/{{Auth::user()->category}}/완료">완료</a></li>
                          <li><a href="/Partner/{{Auth::user()->category}}/실패">실패</a></li>
                      </ul>
                  </div>
              </nav>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr class="head">
                    <th>고객명</th>
                    <th>사업장명</th>
                    <th>주소</th>
                    <th>전화번호</th>
                    <th>접촉시간</th>
                    <th>상태</th>
                    <th>상품</th>
                    <th></th>
                  </tr>
                </thead>
              @if(count($SalesInfo) > 0)
                @foreach($SalesInfo as $SI)
                    <tbody>
                      <tr>
                        <td>{{ $SI->CustomerName }}</td>
                        <td>{{ $SI->BusinessName }}</td>
                        <td>{{ $SI->CustomerAddress }}</td>
                        <td>{{ $SI->PhoneNumber }}</td>
                        <td>{{ $SI->ContactTime }}</td>
                        <td>{{ $SI->state }}</td>
                        <td>{{ $SI->Category }}</td>
                        <td style="display:none">{{ $SI->pay }}</td>
                        <td style="display:none">{{ $SI->created_at }}</td>
                        <td style="display:none">{{ $SI->note }}</td>
                        <td style="display:none">{{ $SI->CustomerEmail }}</td>
                        <td style="display:none">{{ $SI->SalesPerson_id }}</td>
                        <td><a href="/Partner/detail/{{ Auth::user()->category}}/{{ $SI -> id }}">이동</a></td>
                      </tr>
                    </tbody>
                @endforeach
                </table>
              </div>
            @else
              <p> 현재 영업 정보가 없습니다.</p>
            @endif
          </div>

      </div>
    </div>
</div>
@else
    <p> 로그인하세요.</p>
@endif

@endsection
