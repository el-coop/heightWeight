<tbody v-if="type == 'pants'">
@foreach(['Product Measurements' => ['view' => 'title'],'waist' => ['view' => 'product', 'description' => 'Enter the waist circumference of the product'],'length' => ['view' => 'product','description' => 'Enter the length of the product<br><small>*Mandatory variable</small>'],'inseam' => ['view' => 'product','description' => 'Enter the leg inseam of the product'],'Customer Measurements' => ['view' => 'title'],'height' => ['view' => 'customer','description' => 'Enter the height of the potential customer', 'field' => 'metric-imperial-field'],'weight' => ['view' => 'customer','description' => 'Enter the weight of the potential customer', 'field' => 'kg-pound-field']] as $part => $data)
	<tr>
		@component("store.product.table.{$data['view']}Row",compact('part','variants','data','productModel','imagePrefix'))
		@endcomponent
	</tr>
@endforeach
</tbody>
