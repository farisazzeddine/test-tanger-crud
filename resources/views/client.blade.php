@extends('layouts.default')
@section('content')

<div class="col-xl-12 col-lg-9 col-md-12 p-2">
    <div class="row">
{{--        formulaire d'ajoute des clients--}}
        <div class="col-xl-4 col-lg-5 col-md-8">
            <form action="{{action('ClientController@store')}}" method="post" enctype="multipart/form-data" class="border p-1">
                @csrf
                <div class="text-teal text-center text-capitalize font-weight-bold border-bottom align-items-center mb-3 p-2">
                    <h4>les informations du client(e):</h4>
                </div>

                 <div class="d-flex justify-content-between mb-3">
                    <div class="form-group col-lg-6">
                        <label for="nom"><i class="fa fa-user mx-1" aria-hidden="true"></i>Nom:</label>
                        <input type="text" name="nom"  class="form-control @error('nom') is-invalid @enderror" placeholder="Nom..." value="{{old('nom')}}">
                        @error('nom')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="prenom"><i class="fa fa-user mx-1" aria-hidden="true"></i>Prénom</label>
                        <input type="text" name="prenom"  class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom..." value="{{old('prenom')}}">
                        @error('prenom')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                 </div>

                <div class="form-group col-lg-12 mb-3">
                    <label for="email"><i class="fa fa-envelope mx-1" aria-hidden="true"></i>E-mail:</label>
                    <input type="email" name="email"  class="form-control @error('email') is-invalid @enderror" placeholder="E-mail..." value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-group col-lg-6">
                        <label for="telephone"><i class="fa fa-phone" aria-hidden="true"></i> Téléphone:</label>
                        <input type="number" name="telephone"  class="form-control @error('telephone') is-invalid @enderror" placeholder="Téléphone..." value="{{old('telephone')}}">
                        @error('telephone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="cin"><i class="fa fa-id-card-o mx-1" aria-hidden="true"></i>N° CIN:</label>
                        <input type="text" name="cin"  class="form-control @error('cin') is-invalid @enderror" placeholder="Numéro CIN..." value="{{old('cin')}}">
                        @error('cin')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-check d-flex justify-content-between mb-3">
                    <div  class="col-lg-6 align-items-center text-center">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="sex"  value="0" @if(old('sex')) checked @endif>
                            <i class="fa fa-venus mx-1" aria-hidden="true"></i>Femme
                        </label>
                    </div>
                    <div class="col-lg-6 align-items-center text-center">
                        <label class="form-check-label mr-auto">
                            <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="sex"  value="1" @if(old('sex')) checked @endif>
                            <i class="fa fa-mars-stroke mx-1" aria-hidden="true"></i>Homme
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 align-items-center text-center">
                    @error('sex')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-lg-12 border-top border-bottom p-2">
                    <label for="image"><i class="fa fa-camera mx-1" aria-hidden="true"></i>Photo:</label>
                    <input type="file" class="form-control-file" name="photo"  placeholder="image...">
                    @error('photo')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class=" col-lg-12  p-1">
                    <button type="submit" class="btn btn-teal btn-md btn-block
                    ">Enregistre</button>
                </div>
            </form>
        </div>
        {{--  fin de  formulaire d'ajoute des clients--}}

        {{--        affichage des clients--}}
        <div class="col-xl-8 col-lg-7 col-md-6">
            {{-- flash message d'insertion --}}
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- fin de  flash message d'insertion --}}
            <div>
                <table id="datatable" class="table table-hover table-sm table-responsive">
                    <thead>
                    <tr class="text-capitalize">
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">N° CIN</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">sex</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                    <tr>
                        <th scope="row">{{$client->id}}</th>
                        <td><img src="/storage/img/{{$client->photo}}" width="50" alt="{{$client->photo}}"> </td>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->prenom}}</td>
                        <td>{{$client->cin}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->telephone}}</td>
                        <td>@if( $client->sex==1)
                                femme
                            @else
                                Homme
                             @endif
                        </td>
                        <td class="d-flex justify-content-center align-items-center">

                            <a href="{{route('client.edit',$client->id)}}"  ><i class="fa fa-pencil fa-1x mr-2" aria-hidden="true"></i></a>
                            <form action="{{route('client.destroy',$client->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn text-primary" type="submit"><i class="fa fa-trash fa-1x " aria-hidden="true"></i></button>

                            </form>

                        </td>
                    </tr>
                    @empty
                    il'ya pas des client
                    @endforelse

                    </tbody>
                </table>

            </div>
        </div>
        {{--fin d'affichage des clients--}}

    </div>
</div>
@endsection


