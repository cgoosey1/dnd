<div class="modal fade" id="characterModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="post" action="/character/add">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" name="id" id="characterId">
            <input type="hidden" name="locationId" value="{{ ($details instanceof \App\Location? $details->id : ($details instanceof \App\Building? $details->locationId : ''))  }}">
            <input type="hidden" name="buildingId" value="{{ ($details instanceof \App\Building)? $details->id : ''  }}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Character</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Character Name</label>
                    <input type="text" name="name" value="{{ $details->id }}" id="characterName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="race">Character Race</label>
                <select name="race" id="characterRace" class="form-control">
                    <option value="dragonborn">Dragonborn</option>
                    <option value="drow">Drow</option>
                    <option value="dwarf">Dwarf</option>
                    <option value="elf">Elf</option>
                    <option value="gnome">Gnome</option>
                    <option value="half-elf">Half-Elf</option>
                    <option value="half-orc">Half-Orc</option>
                    <option value="halfling">Halfling</option>
                    <option value="human" selected>Human</option>
                    <option value="tiefling">Tiefling</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="description">Character Description</label>
                    <textarea name="description" id="characterDescription" class="form-control"></textarea>
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
