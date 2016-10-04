<!-- Voting Results -->
<div class="col-md-offset-1 col-md-10">
    <div class="row">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <h4>Voting Results<br/>
                    <small>Partial and Unofficial Results.</small>
                </h4>
            </div>

            <div class="panel-body">
                <?php echo form_open(); ?>
                <div class="col-md-12">
                    <?php if (position()): ?>
                        <div class="row">
                            <?php foreach (position() as $pos): ?>
                                <!-- Position -->
                                <div class="col-md-12">
                                    <h3><?= $pos->name ?></h3>
                                    <hr/>
                                </div>

                                <!-- Candidate -->
                                <div class="col-md-12">
                                    <?php if (candidate($pos->id)): ?>
                                        <div class="row">
                                            <?php foreach (candidate($pos->id) as $row): ?>
                                                <div class="col-md-6">
                                                    <div>
                                                        <label>
                                                            <img class="avatar img-circle img-responsive pull-left" src="<?= base_url('assets/img').'/'.$row->avatar ?>">
                                                            <span class="fullname"><?= $row->first_name.nbs().$row->last_name ?></span><br/>
                                                            <small class="result">
                                                                <?php
                                                                $vote_percentage = number_format((count_votes($row->person_id) * 100) / count_voters(), 2);
                                                                $vote_count = count_votes($row->person_id);
                                                                echo 'Receives'.nbs().$vote_count.nbs().'vote'.noun_forms($vote_count).','.nbs().$vote_percentage.'%'.nbs().'of the total.';
                                                                ?>
                                                            </small>
                                                        </label>
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $vote_percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $vote_percentage ?>%">
                                                                <span class="sr-only"><?= $vote_percentage ?>%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-danger">No records found.</div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="alert alert-danger">No records found.</p>
                    <?php endif; ?>

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
