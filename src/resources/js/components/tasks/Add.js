import React, { useCallback, useState } from 'react';
import axios from 'axios';
import TaskForm from './TaskForm';
import SuccessAlert from './SuccessAlert';
import ErrorAlert from './ErrorAlert';

export default function Add() {
	const [name, setName] = useState('');
	const [priority, setPriority] = useState('');
	const [dueIn, setDueIn] = useState('');
	const [alertMessage, setAlertMessage] = useState('');

	const onChange = useCallback((event) => {
		const { value, id } = event.target;

		if (id == 'name')
			setName(value);
		else if (id == 'priority')
			setPriority(value);
		else if (id == 'dueIn')
			setDueIn(value);
	}, [setName, setPriority, setDueIn]);

	const onSubmit = useCallback((event) => {
		event.preventDefault();
		const task = { name, priority, dueIn };

		axios.post('http://localhost:8080/api/tasks/store', task)
			.then(response => {
				if (response.status) {
					setAlertMessage("success");
				} else
					setAlertMessage("error");
			}).catch(() => {
				setAlertMessage("error");
			})
	}, [name, priority, dueIn]);

	return (
		<div>
			{alertMessage == "success" ? <SuccessAlert message={"Task added successfully."} /> : null}
			{alertMessage == "error" ? <ErrorAlert message={"Error occurred while adding the task."} /> : null}

			<form onSubmit={onSubmit}>
				<div className="form-group">
					<TaskForm
						onChange={onChange}
					/>
				</div>
				<button type="submit" className="btn btn-primary btn-block">Submit</button>
			</form>
		</div>
	);
}
