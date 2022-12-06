<?php echo $__env->make('dashboard.components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
enqueue_style('confirm-css');
enqueue_script('confirm-js');

enqueue_script('nice-select-js');
enqueue_style('nice-select-css');

$lang = request()->get('lang', 'none');
$site_language = get_option('site_language', 'none');
if ($site_language != 'none' && $lang == 'none') {
    $lang = $site_language;
}
?>
<div id="wrapper">
    <?php echo $__env->make('dashboard.components.top-bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-page">
        <div class="content mt-2">
            
            <div class="card-box page-translation">
                <div class="header-area d-flex align-items-center">
                    <h4 class="header-title mb-0"><?php echo e(__('Text Translation')); ?></h4>
                    <a class="btn btn-primary ml-3 hh-link-action hh-link-scan-translation  btn-xs btn-success"
                       data-page-loading="true"
                       data-action="<?php echo e(dashboard_url('scan-translation')); ?>"
                       data-parent="tr"
                       data-is-delete="false"
                       data-params="<?php echo e(base64_encode(json_encode(['scan' => true, 'lang' => $lang]))); ?>"
                       href="javascript: void(0)">
                        <?php echo e(__('Scan Text')); ?>

                    </a>
                </div>

                <form action="<?php echo e(dashboard_url('update-translate')); ?>" class="form form-action" method="post"
                      data-validation-id="form-update-translate"
                      data-encode="true">
                    <?php echo $__env->make('common.loading', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="form-inline">
                            <label for="hh-choose-langs" class="mr-2"><?php echo e(__('Languages')); ?></label>
                            <select id="hh-choose-langs" data-plugin="customselect"
                                    class="form-control form-control-sm min-w-200" name="lang"
                                    data-url="<?php echo e(dashboard_url('translation')); ?>">
                                <option value="none"><?php echo e(__('Select language')); ?></option>
                                <?php if(!empty($langs)): ?>
                                    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e(($k == $lang) ? 'selected' : ''); ?> value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success right btn-scan-translation">
                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span>
                            <?php echo e(__('Save Translation')); ?>

                        </button>
                    </div>
                    <?php if($lang == 'none' || !isset($langs[$lang])): ?>
                        <div class="alert alert-warning"><?php echo e(__('Please select a language before translating')); ?></div>
                    <?php endif; ?>

                    <div class="translation-search">
                        <input id="input-search-translation" class="form-control" type="text"
                               placeholder="<?php echo e(__('Enter search text...')); ?>"/>
                        <button type="button" class="btn btn-success"><i class="ti-search mr-1"></i> <?php echo e(__('Search')); ?>

                        </button>
                    </div>

                    <div class="table-responsive table-translations">
                        <?php if(!empty($strings)): ?>
                            <table class="table mb-0 h-100">
                                <colgroup width="35%"></colgroup>
                                <colgroup></colgroup>
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('Origin Text')); ?>

                                        (<?php echo e(__(':number items', ['number' => count($strings)])); ?>)
                                    </th>
                                    <th><?php echo e(__('Translation Text')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $strings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row" class="align-middle"><?php echo e($v); ?></th>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                   name="<?php echo e(base64_encode($v) . '_' . time()); ?>"
                                                   value="<?php echo e(isset($translation[$v]) ? $translation[$v] : ''); ?>"/>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="text-danger"><?php echo e(__('No Text to translate')); ?></div>
                        <?php endif; ?>
                    </div>
                    <hr/>
                    <button type="submit" class="mt-2 btn btn-success">
                        <span class="btn-label"><i class="mdi mdi-check-all"></i></span>
                        <?php echo e(__('Save Translation')); ?>

                    </button>
                </form>
            </div>
            
            <?php echo $__env->make('dashboard.components.footer-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php echo $__env->make('dashboard.components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/salentovacanze/public_html/app/Views/dashboard/screens/administrator/translation.blade.php ENDPATH**/ ?>