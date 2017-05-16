<?php if (!empty($getdata2)): ?>
  <!-- <tr>
    <th>
      <label class="col-sm-3"><?php echo(__('子カテゴリ')); ?></label>
    </th> -->
    <td>
      <div class="col-sm-9">
        <select name="data[Post][sub_category_id]">
          <?php foreach($getdata2 as $key => $val): ?>
            <option value="<?php echo $val['SubCategory']['id']; ?>"> <?php echo $val['SubCategory']['sub_category']; ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
    </td>
  <!-- </tr> -->
<?php else: ?>

<?php endif; ?>
