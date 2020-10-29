import React from 'react';
import PropTypes from "prop-types";


export default function TaskForm(props) {
  const { onChange, name, priority, dueIn } = props;

  return (
    <div>
      <table className="table table-striped table-hover table-sm">
        <thead className="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Task Name</th>
            <th scope="col">Priority</th>
            <th scope="col">Due In</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>
              <input type="text"
                className="form-control"
                id="name"
                value={name}
                onChange={onChange}
                placeholder="Enter Tasks Name" />
            </td>
            <td>
              <input type="number"
                className="form-control"
                id="priority"
                value={priority}
                onChange={onChange}
                placeholder="Enter Tasks Name" />
            </td>
            <td>
              <input type="number"
                className="form-control"
                id="dueIn"
                value={dueIn}
                onChange={onChange}
                placeholder="Enter Tasks Name" />
            </td>
          </tr>
        </tbody>
      </table >
    </div>
  );
}

TaskForm.propTypes = {
  name: PropTypes.string,
  priority: PropTypes.oneOfType([
    PropTypes.string,
    PropTypes.number,
  ]),
  dueIn: PropTypes.oneOfType([
    PropTypes.string,
    PropTypes.number,
  ]),
  onChange: PropTypes.func,
}
