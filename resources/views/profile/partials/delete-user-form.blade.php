<section class="space-y-6">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
        Supprimer
    </button>

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Title">Êtes-vous sûr de vouloir supprimer votre compte ?</h5>

                </div>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <div class="modal-body">




                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer la suppression définitive de votre compte.
    ') }}
                            </p>

                            <div class="mt-6">
                                @include('shared.input',['type'=>'password','label'=>'Password','name'=>'password','required'=>true])
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</section>
