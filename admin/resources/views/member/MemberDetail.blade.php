@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        회원 정보 상세
                    </div>
                    <div class="panel-body">
                        @foreach( $users as $user)
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>회원 아이디</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>회원명</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>성별</td>
                                        @if ($user->gender == 0 )
                                            <td>{{ '남자' }}</td>
                                        @else
                                            <td>{{ '여자' }}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>핸드폰 번호</td>
                                        <td>{{ $user->phoneNumber }}</td>
                                    </tr>
                                    <tr>
                                        <td>은행명</td>
                                        <td>{{ $user->bankName }}</td>
                                    </tr>
                                    <tr>
                                        <td>계좌 번호</td>
                                        <td>{{ $user->accountNumber }}</td>
                                    </tr>
                                    <tr>
                                        <td>회원 등급</td>
                                        @if ($user->type == 0)
                                            <td>일반회원</td>
                                        @elseif ($user->type == 1)
                                            <td>정회원</td>
                                        @elseif ($user->type == 2)
                                            <td>벤더사</td>
                                        @elseif ($user->type == 3)
                                            <td>차단회원</td>
                                        @elseif ($user->type == 4)
                                            <td>A 클래스 회원</td>
                                        @elseif ($user->type == 5)
                                            <td>정회원 대기 회원</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>추천인</td>
                                        <td>{{ $user->recommender }}</td>
                                    </tr>
                                    <tr>
                                        <td>등록일</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>추천인 코드</td>
                                        <td>{{ $user->recommend_code }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer">
                        @if( $user->type == 1)
                            {!! Form::open(['action' => ['MemberController@update', $user->id], 'method' => 'POST']) !!}
                            {{Form::hidden('type', 1,['class' => 'form-control'])}}
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('블랙리스트로 변경',['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                        @endif

                        @if( $user->type == 3)
                            {!! Form::open(['action' => ['MemberController@update', $user->id], 'method' => 'POST']) !!}
                            {{Form::hidden('type', 3,['class' => 'form-control'])}}
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('정회원으로 변경',['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                        @endif

                        @if( $user->type == 5)
                            {!! Form::open(['action' => ['MemberController@update', $user->id], 'method' => 'POST']) !!}
                            {{Form::hidden('type', 5,['class' => 'form-control'])}}
                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('정회원으로 변경',['class' => 'btn btn-primary'])}}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
