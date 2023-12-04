	public function get_data_table_of_student_enquiry()
	{
		$draw 		= intval($this->input->post("draw"));
		$questions 	= $this->get_annual_calendar_table_data($is_get_total_record = FALSE);
		$data 		= array();
		$start = intval($this->input->post("start"));

		foreach ($questions as $index => $rows) {

			$privilige = $this->Md_database->getPriviliges();

			if ((in_array('masterclass_edit', $privilige))) {
				$edit_btn = '<a href="' . base_url('edit-student-enquiry/' . $rows->id) . '" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>';
			} else {
				$edit_btn = '<button type="button" class="btn btn-warning btn-xs" title="Access denied" disabled=""><i class="fa fa-pencil"></i></button>';
			}

            if ((in_array('masterclass_edit', $privilige))) {
				$view_btn = '<a href="' . base_url('view-student-enquiry/' . $rows->id) . '" class="btn btn-primary btn-xs" title="View"><i class="fa fa-eye"></i></a>';
			} else {
				$view_btn = '<button type="button" class="btn btn-warning btn-xs" title="Access denied" disabled=""><i class="fa fa-eye"></i></button>';
			}

			if ((in_array('masterclass_delete', $privilige))) {
				$delete_btn = '<a href="javascript:void(0);" data-id="' . $rows->id . '" class="btn btn-danger btn-xs delete-record-student-enquiry" title="Delete" ><i class="fa fa-trash"></i></a>';
			} else {
				$delete_btn = '<button type="button" class="btn btn-danger btn-xs" title="Access denied" disabled=""><i class="fa fa-trash"></i></button>';
			}

			$data[] = array(
				($start + 1),
				!empty($rows->created_at) ? date('d M Y', strtotime($rows->created_at)) : '',
                !empty($rows->branch_name) ? ucwords($rows->branch_name) : '',
                !empty($rows->class_name) ? ucwords($rows->class_name) : '',
                !empty($rows->enquiry_id) ? ucwords($rows->enquiry_id) : '',
                !empty($rows->name) ? ucwords($rows->name) : '',
                !empty($rows->father_mobile_no) ? ucwords($rows->father_mobile_no) : '',
                !empty($rows->enquiry_status) ? ucwords($rows->enquiry_status) : '-',
				$view_btn .' ' . $edit_btn . ' ' . $delete_btn . ' ',
			);
			$start++;
		}

		$total_employees = $this->get_annual_calendar_table_data(TRUE);
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_employees,
			"recordsFiltered" => $total_employees,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	/**
	 * ***************Function to get class table data **********
	 * @type : Function
	 * @function name : get_annual_calendar_table_data
	 * @description : Get "class table data" admin interface
	 * @param : is_get_total_record
	 * @designer : Yogita Patil
	 * @author : Atul Naik
	 * @return : query result
	 ********************************************************* */
	public function get_annual_calendar_table_data($is_get_total_record = FALSE)
	{
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];

		$valid_columns = array(
			0 => 'NESE.id',
			1 => 'NESE.class_name',
			2 => 'NESE.branch_name',
            3 => 'NESE.name',
            4 => 'NESE.created_at',
            5 => 'NESE.father_mobile_no',
            6 => 'NESE.enquiry_id',
           
		);

		if (!empty($search)) {
			$this->db->where("NEMC.class_name LIKE '%" . $search . "%'");
		}

		/*--start--*/
		$this->db->select('NESE.id,NEMC.class_name,NEMB.branch_name,NESE.name,NESE.created_at,NESE.father_mobile_no,NESE.enquiry_id,NESE.enquiry_status');


		$this->db->from(NEW_ERA_STUDENT_ENQUIRY . ' NESE');
        $this->db->join(NEW_ERA_MASTER_BRANCH . ' NEMB','NEMB.id = NESE.enquiry_branch_id');
        $this->db->join(NEW_ERA_MASTER_CLASS . ' NEMC','NEMC.id = NESE.enquiry_class_id');
		$this->db->where('NESE.status<>', "3");
		$this->db->order_by('NESE.id', 'ASC');
		if ($is_get_total_record == TRUE) {
			return $this->db->get()->num_rows();
		} else {
			$this->db->limit($length, $start);
			return $this->db->get()->result();
		}
		/*--stop--*/
	}
