$(document).ready(function() {
       var table= $('#example').DataTable( {
       fixedHeader: {
	   								 	    				               header: true,
	   								 					            },
	   								 					          colReorder: true,
	   								 					          fixedColumns:   {
	   								 					                   leftColumns: 0
	   								 								                },
	   								 						      rowReorder: true,
	   								 						        dom: 'Bfrtip',
	   								 							  lengthMenu:[
	   								 							             [10,25,50,-1],
	   								 							             ['10 rows', '25 rows', '50 rows', 'Show all']
	   								 							             ],

	   								 							          buttons: [
           {
            extend:'pageLength',
            text: '<i class="fa fa-list-ol" aria-hidden="true" style="color:blue"></i>',
            titleAttr: 'show no.of rows'

            },
    {

                    extend: 'colvis',
                    text: '<i class="fa fa-columns" aria-hidden="true" style="color:blue"></i>',
                    titleAttr: 'Column Visibility',
                    exportOptions: {
                        columns: ':visible',
                    }
            },



              {
			                extend:    'pdfHtml5',
							                text:      '<i class="fa fa-file-pdf-o" style="color:red"></i>',
                titleAttr: 'PDF',

			                exportOptions: {
			                    columns: ':visible',
			                     modifier: {
								                    page: 'current'
                }
			                }
            },
            {
			                extend:    'excelHtml5',
							                text:      '<i class="fa fa-file-excel-o" style="color:green"></i>',
                titleAttr: 'Excel',
			                exportOptions: {
			                    columns: ':visible'
			                }
            },

            {
             				extend:    'copyHtml5',
                							text:      '<i class="fa fa-files-o" style="color:green"></i>',
                titleAttr: 'Copy',
                			exportOptions: {
				                	modifier: {
				                    	page: 'current'
				                			  }
            }

                },
                {
				            extend:    'csvHtml5',
				                			text:      '<i class="fa fa-file-text-o" style="color:green"></i>',
				titleAttr: 'CSV',
							exportOptions: {columns: ':visible',
								modifier: {
										page: 'current'
				                		  }
							}

            },
        ],
	   								 							      scrollY:        true,
	   								 							      deferRender:    true,
	   								 	    						  scroller:       true,
	   								 	    						  scrollX:        true,
								 	        			          scrollCollapse: true,
       select:true,
           initComplete: function () {
               this.api().columns().every( function () {
                   var column = this;
                   var select = $('<select><option value=""></option></select>')
                       .appendTo( $(column.footer()).empty() )
                       .on( 'change', function () {
                           var val = $.fn.dataTable.util.escapeRegex(
                               $(this).val()
                           );
                           table.column()
                               .search( val ? '^'+val+'$' : '', true, false )
                               .draw();
                       } );

                   column.data().unique().sort().each( function ( d, j ) {
                       select.append( '<option value="'+d+'">'+d+'</option>' )
                   } );
               } );
           }
       } );
       $('#chk').on( 'click', function () {
	   		   if($('#chk').prop('checked')){
	   		        table.fixedHeader.enable();
	   		        alert('Enabled Fixed Header');
	   		        }
	         else
	            if(!$('#chk').prop('checked')){
	   		        table.fixedHeader.disable();
	   		        alert('Disabled Fixed Header');
	   		        }
	       } );

} );
