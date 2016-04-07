<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller'=>'users','action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Images'), ['controller'=>'images','action' => 'index']) ?></li>
    </ul>
</nav>
<div class="images index large-9 medium-8 columns content">
    <h3><?= __('Images') ?></h3>
    <?= $this->Form->create('Image') ?>
        <div class="col-xs-6">  
            <?= $this->Form->input('name',['label'=>false,'div'=>false,'class'=>'form-control','value'=>'']); ?>
            <?= $this->Form->button(__('Submit')) ?>
        </div>
        <?= $this->Form->end() ?>
        <?= $this->Html->link(__('Export'), ['action' => 'export'], ['class'=>'button right']) ?>
    
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <td><?= $this->Paginator->sort('image') ?></td>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $image): ?>
            <tr>
                <td><?= $this->Number->format($image->id) ?></td>
                <td><?= h($image->name) ?></td>
                 <td><?= $this->Html->image($image->thumb_link) ?></td>
                <td><?= h($image->created) ?></td>
                <td class="actions">
                    
                    <?= $this->Html->link(__('Zip'), ['action' => 'imagetozip', $image->id]) ?> | 
                    <?= $this->Html->link(__('PDF'), ['action' => 'imagetopdf', $image->id]) ?> |
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
