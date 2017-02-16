<script>
    angular.module('dnd.controllers').value("traps", {
        @foreach ($details->traps as $trap)
        {{ $trap->id }}: {
                id: {{ $trap->id }},
                locationId: {{ $trap->locationId }},
                questId: {{ $trap->questId ?: 'null' }},
                name: "{{ $trap->name }}",
                type: "{{ $trap->type }}",
                difficulty: "{{ $trap->difficulty }}",
                characterLevel: "{{ $trap->characterLevel }}",
                trigger: "{{ $trap->trigger }}",
                description: "{{ $trap->description }}",
                detectDC: {{ $trap->detectDC }},
                disarmDC: {{ $trap->disarmDC }},
                saveDC: {{ $trap->saveDC }},
                attackMod: "{{ $trap->attackMod }}",
                damage: "{{ $trap->damage }}",
                complex: {{ $trap->complex }},
                template: {{ $trap->template }},
                initiative: {{ $trap->initiative ?: 'null' }},
                spellId: {{ $trap->spell ?: 'null' }},
                spellcasterLevel: {{ $trap->spellcasterLevel ?: 'null' }}
            }{{ !$loop->last? ',' : '' }}
        @endforeach
    });
</script>

<script src="/js/angular/controllers/TrapCtrl.js"></script>
<script src="/js/angular/services/TrapService.js"></script>

<div ng-controller="TrapCtrl" class="modal fade" id="trapModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="post" action="/trap/add">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input type="hidden" name="id" value="@{{ trap.id }}">
            <input type="hidden" name="locationId" value="{{ ($details instanceof \App\Location? $details->id : ($details instanceof \App\Quest? $details->locationId : ''))  }}">
            @if ($details instanceof \App\Quest)
                <input type="hidden" name="questId" value="{{ $details->id  }}">
            @endif
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Trap</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" ng-model="trap.name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" ng-model="trap.type" class="form-control">
                        <option value="{{ \App\Trap::TYPE_MECHANICAL }}">Mechanical</option>
                        <option value="{{ \App\Trap::TYPE_MAGICAL }}">Magical</option>
                    </select>
                </div>
                <div class="form-inline row">
                    <div class="form-group col-sm-6">
                        <label>Difficulty</label>
                        <select name="difficulty" ng-model="trap.difficulty" ng-change="updateDC()" class="form-control">
                            <option value="{{ \App\Trap::DIFFICULTY_SET_BACK }}" selected>Set Back</option>
                            <option value="{{ \App\Trap::DIFFICULTY_DANGEROUS }}">Dangerous</option>
                            <option value="{{ \App\Trap::DIFFICULTY_DEADLY }}">Deadly</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Character Level</label>
                        <select name="characterLevel" ng-model="trap.characterLevel"  ng-change="updateDC()" class="form-control">
                            <option value="1" selected>1st - 4th</option>
                            <option value="2">5th - 10th</option>
                            <option value="3">11th - 16th</option>
                            <option value="4">17th - 20th</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="trigger">Trigger</label>
                    <input type="text" name="trigger" ng-model="trap.trigger" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" ng-model="trap.description" class="form-control"></textarea>
                </div>

                <div class="form-inline row">
                    <div class="form-group col-sm-6">
                        <label for="detectDC">Detect DC</label>
                        <input type="number" class="form-control" name="detectDC" ng-model="trap.detectDC">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="disarmDC">Disarm DC</label>
                        <input type="number" class="form-control" name="disarmDC" ng-model="trap.disarmDC">
                    </div>
                </div>

                <div class="form-inline row m-t-m">
                    <div class="form-group col-sm-6">
                        <label for="saveDC">Save DC</label>
                        <input type="number" class="form-control" name="saveDC" ng-model="trap.saveDC">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="damage">Damage</label>
                        <input type="text" class="form-control" name="damage" ng-model="trap.damage">
                    </div>
                </div>

                <div class="form-inline row m-t-m">
                    <div class="checkbox form-group col-sm-6">
                        <label>
                            <input type="checkbox" value="1" ng-model="trap.template" name="template">
                            Template
                        </label>
                    </div>
                    <div class="checkbox form-group col-sm-6">
                        <label>
                            <input type="checkbox" value="1" name="complex" ng-model="trap.complex">
                            Complex Trap?
                        </label>
                    </div>
                </div>

                <div class="form-inline row m-t-m" ng-show="trap.complex">
                    <div class="form-group col-sm-6">
                        <label for="attackMod">Attack Mod</label>
                        <input type="text" class="form-control" name="attackMod" ng-model="trap.attackMod">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="initiative">Initiative</label>
                        <input type="number" class="form-control" name="initiative" ng-model="trap.initiative">
                    </div>
                </div>

                <div class="m-t-m" ng-show="trap.complex == '1' || trap.type == '{{ \App\Trap::TYPE_MAGICAL }}'">
                    <div class="form-group">
                        <label for="name">Spell</label>
                        <input type="hidden" name="spell" value="@{{ trap.spellId }}" class="form-control">
                        <ng-search search-action="fillSpellId" id="trapModal" />
                    </div>

                    <div class="form-group">
                        <label for="saveDC">Spellcaster Level</label>
                        <input type="number" class="form-control" name="spellcasterLevel" ng-model="trap.spellcasterLevel">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cleanForm()">Close</button>
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
