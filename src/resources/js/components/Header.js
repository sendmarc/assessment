import React from "react";

import { Nav, Title } from "./styles";

export default function Header() {
	return (
		<Nav>
			<Title>
				<span role="img" aria-label="Cowboy emoji">
					🤠
        </span>
        Welcome!
      </Title>
		</Nav>
	);
}
