import React, { useEffect, useCallback, useState } from 'react';
import axios from 'axios';
import TaskForm from './TaskForm';
import SuccessAlert from './SuccessAlert';
import ErrorAlert from './ErrorAlert';
import PropTypes from "prop-types";

export default function Edit(props) {
	const [name, setName] = useState('');
	const [priority, setPriority] = useState('');
	const [dueIn, setDueIn] = useState('');
	const [alertMessage, setAlertMessage] = useState('');

	const { match } = props

	useEffect(() => {
		axios.get('http://localhost:8080/api/tasks/' + match.params.id)
			.then(response => {
				const { data } = response;

				setName(data.name);
				setPriority(data.priority);
				setDueIn(data.dueIn);
			});
	}, [match.params.id]);


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

		axios.put('http://localhost:8080/api/tasks/update/' + match.params.id, task)
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
			{alertMessage == "success" ? <SuccessAlert message={"Task updated successfully."} /> : null}
			{alertMessage == "error" ? <ErrorAlert message={"Error occurred while updating the task."} /> : null}

			<form onSubmit={onSubmit}>
				<div className="form-group">
					<TaskForm
						name={name}
						priority={priority}
						dueIn={dueIn}
						onChange={onChange}
					/>
				</div>
				<button type="submit" className="btn btn-primary btn-block">Submit</button>
			</form>
		</div>
	);
}

Edit.propTypes = {
	match: PropTypes.object,
}
