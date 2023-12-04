	if (!empty($this->input->post())) {
			$this->form_validation->set_rules('enquiry_branch_id', 'Branch id', 'trim|required');
            $this->form_validation->set_rules('enquiry_class_id', 'Class id', 'trim|required');
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('father_mobile_no', 'Father mobile no', 'trim|required');
			if ($this->form_validation->run() === FALSE) {
				$this->session->set_flashdata('error', validation_errors());
				redirect($_SERVER['HTTP_REFERER']);
				exit();
			}
