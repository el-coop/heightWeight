<tbody v-if="type == 'other'">
@foreach(['Customer Measurements' => ['view' => 'title'],'height' => ['view' => 'customer','description' => 'Enter the height of the potential customer', 'field' => 'metric-imperial-field'],'weight' => ['view' => 'customer','description' => 'Enter the weight of the potential customer', 'field' => 'kg-pound-field']] as $part => $data)
	<tr>
		@component("store.product.table.{$data['view']}Row",compact('part','variants','data','productModel'))
		@endcomponent
	</tr>
@endforeach
</tbody>
