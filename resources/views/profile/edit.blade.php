@extends('layouts.app')

@section('title-section', 'Profil')

@section('content')

<div class="page-header">
    <div>
        <h1>Profil</h1>
        <div class="subtitle">Kelola informasi akun Anda</div>
    </div>
</div>

<div class="glass-card" style="max-width:700px;margin-bottom:20px;">
    @include('profile.partials.update-profile-information-form')
</div>

<div class="glass-card" style="max-width:700px;margin-bottom:20px;">
    @include('profile.partials.update-password-form')
</div>

<div class="glass-card" style="max-width:700px;">
    @include('profile.partials.delete-user-form')
</div>

@endsection
