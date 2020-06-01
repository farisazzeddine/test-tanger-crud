@extends('layouts.default')
@section('content')

{{--start of update form--}}

        <div class="col-xl-8 col-lg-9 col-md-10  offset-xl-2 offset-lg-1 offset-md-1">
            <div class="text-teal text-center bg-teal text-light  text-capitalize font-weight-bold border-bottom align-items-center mb-3 p-2">
                <h4>mettre à jour le contenu</h4>
            </div>

            <form  action="{{route('client.update', $client_edit->id )}}" method="POST"  enctype="multipart/form-data" class="border p-1">
                @csrf
                @method('PUT')
                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-group col-lg-6">
                            <label for="nom"><i class="fa fa-user mx-1" aria-hidden="true"></i>Nom:</label>
                            <input type="text" name="nom" id="nom" value="{{ $client_edit->nom }}" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom..." >
                            @error('nom')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="prenom"><i class="fa fa-user mx-1" aria-hidden="true"></i>Prénom</label>
                            <input type="text" name="prenom"  id="prenom" value="{{ $client_edit->prenom }}" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom...">
                            @error('prenom')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-lg-12 mb-3">
                        <label for="email"><i class="fa fa-envelope mx-1" aria-hidden="true"></i>E-mail:</label>
                        <input type="email" name="email" value="{{ $client_edit->email }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail...">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-group col-lg-6">
                            <label for="telephone"><i class="fa fa-phone" aria-hidden="true"></i> Téléphone:</label>
                            <input type="number" name="telephone" value="{{ $client_edit->telephone }}"  id="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Téléphone...">
                            @error('telephone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="cin"><i class="fa fa-id-card-o mx-1" aria-hidden="true"></i>N° CIN:</label>
                            <input type="text" name="cin"  value="{{ $client_edit->cin }}" id="cin" class="form-control @error('cin') is-invalid @enderror" placeholder="Numéro CIN...">
                            @error('cin')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>


                    <div class="form-check d-flex justify-content-between mb-3">
                        <div  class="col-lg-6 align-items-center text-center">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input  @error('gender') is-invalid @enderror" {{ $client_edit->sex == '0' ? 'checked' : '' }} name="sex" id="sex" value="0" >
                                <i class="fa fa-venus mx-1" aria-hidden="true"></i>Femme
                            </label>
                        </div>
                        <div class="col-lg-6 align-items-center text-center">
                            <label class="form-check-label mr-auto">
                                <input type="radio" class="form-check-input   @error('gender') is-invalid @enderror" {{ $client_edit->sex == '1' ? 'checked' : '' }} name="sex"  id="sex" value="1" >
                                <i class="fa fa-mars-stroke mx-1" aria-hidden="true"></i>Homme
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12 align-items-center text-center">
                        @error('sex')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 border-top border-bottom p-2 d-flex justify-content-between">
                        <div>
                            <label for="image"><i class="fa fa-camera mx-1" aria-hidden="true"></i>Photo:</label>
                            <input type="file" class="form-control-file" name="photo"  id="photo" value="photo"  placeholder="image...">
                            @error('photo')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror

                        </div>

                        <img src="/storage/img/{{ $client_edit->photo}}" width="80" alt="{{ $client_edit->photo}}">
                        <input type="hidden" name="hidden_img" value="{{ $client_edit->photo}}">

                    </div>

                <div class=" col-lg-12  p-1">
                    <button type="submit" class="btn btn-teal btn-md btn-block text-capitalize">actualiser le contenu</button>

                </div>

            </form>
        </div>


{{-- end of update form--}}

@endsection
