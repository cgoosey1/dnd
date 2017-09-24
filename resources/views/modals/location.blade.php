<script src="/js/angular/controllers/LocationCtrl.js"></script>

<div class="modal fade" id="locationModal" ng-controller="LocationCtrl" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="post" action="/location/add">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Location</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="" id="characterName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                    <select name="type" class="form-control">
                        @foreach(\App\LocationType::all()->reverse() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Parent</label>
                        <input type="hidden" name="parent" value="@{{parent}}" class="form-control">
                        <ng-search search-action="fillParent" type="Location" id="locationSearch" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
